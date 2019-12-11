<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Member;
use App\Community;
use App\Entry;
use App\Event;
use App\Follow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Storage;

class UserController extends Controller
{
    public function index($user_id){
        $user = User::find($user_id);
        $user->prefecture = config('prefectures')[$user->prefecture];
        $user->ride_type = explode(",", $user->ride_type);
        $total = null;
        foreach ($user->ride_type as $key => $ride_type) {
            $type = config('ride_type')[$ride_type];
            $total = $total.$type."  ";
        }
        $user->ride_type = $total;

        $members = Member::where('user_id', $user_id)->get();
        $communities = [];
        if(isset($members)){
            foreach($members as $member){
                $communities[] = Community::find($member->community_id);
            }
        }
        $dt = Carbon::now();
        $entries = Entry::where('user_id', $user_id)->get();
        $events = [];
        if(isset($entries)){
            foreach($entries as $entry){
                $event = Event::where('id', $entry->event_id)->where('start_at', '>=', $dt)->first();
                if(isset($event)){
                    $events[] = $event;
                }
            }
        }
        // dd();
        $entries = Entry::where('user_id', $user_id)->where('role_type', 1)->get();
        $events_1 = [];
        if(isset($entries)){
            foreach($entries as $entry){
                $event = Event::where('id', $entry->event_id)->where('start_at', '>=', $dt)->first();
                if(isset($event)){
                    $events_1[] = $event;
                }
            }
        }
        $my_user_id = Auth::id();
        $follow = Follow::where('follow_id', $my_user_id)->where('follower_id', $user_id)->first();
        $follow_user_list = Follow::where('follow_id', $user_id)->get();
        $follow_user = [];
        foreach($follow_user_list as $follow_list){
            $follow_user[] = User::find($follow_list->follower_id);
        }
        $follower_user_list = Follow::where('follower_id', $user_id)->get();
        $follower_user = [];
        foreach($follower_user_list as $follower_list){
            $follower_user[] = User::find($follower_list->follow_id);
        }
        return view('user/index', ['user' => $user, 'communities'=>$communities, 'events'=>$events, 'events_1'=>$events_1, 'follow'=>$follow, 'my_user_id'=>$my_user_id, 'follow_user'=>$follow_user, 'follower_user'=>$follower_user]);
    }
    public function edit(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->ride_type = explode(",", $user->ride_type);
        $user->mail_preference = explode(",", $user->mail_preference);
        return view('user/edit', ['user' => $user]);
    }
    public function update(Request $request)
    {
        // Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'prefecture' => ['required', 'min:0'],
        //     'ride_type' => ['required', 'string'],
        // ]);
        // 下のようになる。
        $myEmail = Auth::user()->email;
        $user_id = Auth::id();
        $user = Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->whereNot('name', $user->name)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNot('email', $myEmail)],
            'prefecture' => ['required', 'gt:0'],
            'ride_type' => ['required'],
            // 'image_path' => ['image']
            ]);
            // ここから下の処理はバリデーションを通過したときに実行される（適切な入力値だった）
        $user->name = $request->name;
        $user->email = $request->email;
        $user->prefecture = $request->prefecture;
        $ride_type = $request->ride_type;
        $ride_type = implode(",", $ride_type);
        $user->profile = $request->profile;
        if(isset($request->image_path)){
            $path = Storage::disk('s3')->putFile('fanride', $request->image_path, 'public');
            $user->image_path = Storage::disk('s3')->url($path);
        }   
        $mail_preference = $request->mail_preference;
        $mail_preference = implode(",", $mail_preference);
        User::find($user_id)->update([
            'name'=>$user->name,
            'email'=>$user->email,
            'prefecture'=>$user->prefecture,
            'ride_type'=>$ride_type,
            'profile'=>$user->profile,
            'image_path'=>$user->image_path,
            'mail_preference'=>$mail_preference
        ]);
        return redirect("user/$user_id");
    }

}
