<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Community;
use App\Member;
use App\Entry;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Storage;
use Carbon\Carbon;


class CommunityController extends Controller
{
    public function index($community_id){
        $community = Community::find($community_id);
        $user_id = Auth::id();
        $member_0 = Member::where('community_id', $community_id)->where('role_type', '0')->get();
        $user_0 = [];
        foreach($member_0 as $member){
            $user_0[] = User::find($member->user_id);
        }
        $user_1 = [];
        $member_1 = Member::where('community_id', $community_id)->where('role_type', '1')->get();
        foreach($member_1 as $member){
            $user_1[] = User::find($member->user_id);
        }
        $member_user = Member::where('community_id', $community_id)->where('user_id', $user_id)->first();
        $member_num = count($member_0)+count($member_1);
        $dt = Carbon::now();
        $events = Event::where('community_id', $community_id)->where('start_at', '>=', $dt)->get();
        $Parsedown = new \Parsedown();
        $community->description = $Parsedown->text($community->description);
        return view('community/index', [
             'community'=>$community,
             'user_0'=>$user_0, 
             'user_1'=>$user_1, 
             'member_user'=>$member_user, 
             'member_num'=>$member_num, 
             'events'=>$events, 
             ]);
    }
    public function register(){
        $user_id = Auth::id();
        $user_name = User::find($user_id)->name;
        return view('community/register', ['user_name'=>$user_name]);
    }
    public function copiRegister($community_id){
        $user_id = Auth::id();
        $user_name = User::find($user_id)->name;
        $community = Community::find($community_id);
        return view('community/copiRegister', ['user_name'=>$user_name, 'community'=>$community]);
    }
    public function create(Request $request){
            $request->validate([
                'image_path' => ['image'],
                'community_title' => ['required', 'string', 'max:255','unique:communities,community_title,deleted_at,null'],
            ]);
            if(isset($request->image_path)){
                $path = Storage::disk('s3')->putFile('fanride', $request->image_path, 'public');
                $image_path = Storage::disk('s3')->url($path);
            }else{
                $image_path = $request->image_path;
            }            
            $community_title = $request->community_title;
            $community_subtitle = $request->community_subtitle;
            $community_manage = $request->community_manage;
            $description = $request->description;
            Community::create([
                'image_path'=>$image_path,
                'community_title'=>$community_title,
                'community_subtitle'=>$community_subtitle,
                'community_manage'=>$community_manage,
                'description'=>$description,
                ]);
            $community = Community::where('community_title', $community_title)->first();
            $community_id = $community->id;
            $user_id = Auth::id();
            $role_type = 1;
            Member::create([
                'community_id'=>$community_id,
                'user_id'=>$user_id,
                'role_type'=>$role_type,
                ]);
                    // dd('1');
            return redirect("community/$community_id");
    }
    public function edit($community_id){
        $community = Community::find($community_id);
        return view('community/edit', ['community'=>$community]);
    }
    public function update(Request $request){
        $community_id = $request->community_id;
        $community = Community::find($community_id);
        $request->validate([
            'image_path' => ['image'],
            'community_title' => ['required', 'string', 'max:255', Rule::unique('communities', 'community_title')->whereNot('community_title', $community->community_title) ],
        ]);
        if(isset($request->image_path)){
            $path = Storage::disk('s3')->putFile('fanride', $request->image_path, 'public');
            $community->image_path = Storage::disk('s3')->url($path);
        }
        $community->community_title = $request->community_title;
        $community->community_subtitle = $request->community_subtitle;
        $community->community_manage = $request->community_manage;
        $community->description = $request->description;
        $community->save();

        return redirect("community/$community_id");
    }
    public function delete($community_id){
        Community::find($community_id)->delete();
        Member::where('community_id', $community_id)->delete();
        $user_id = Auth::id();
        $entry_num = Entry::where('user_id', $user_id)->where('role_type', '1')->get();
        $event_num = [];
        foreach($entry_num as $key => $entry){
            $event_num[$key] = Event::where('id', $entry->event_id)->first();
        }
        $management_community_array = Member::where('user_id', $user_id)->where('role_type', '1')->get();
        $community_num = [];
        $community_event_num = [];
        $community_member_num = [];
        // $community_id = Member::where('community_id', '1')->first();
        // dd($community_id);
        foreach ($management_community_array as $key => $management_community) {
            $community_num[$key] = Community::where('id', $management_community->community_id)->first();
            $community_member = Member::where('community_id', $management_community->community_id)->get();
            $community_member_num[$key] = count($community_member);
            $community_event = Event::where('community_id', $management_community->community_id)->get();
            $community_event_num[$key] = count($community_event);
        }
        return view('event/management', [
            'event_num'=>$event_num,
            'community_num'=>$community_num,
            'community_member_num' =>$community_member_num,
            'community_event_num' =>$community_event_num,
            ]);
    }
    public function new(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->prefecture = config('prefecture')[$user->prefecture];
        $new_communities = Community::orderBy('created_at', 'desc')->get();
        return view('/community/new', ['new_communities'=>$new_communities]);
    }
    public function popular(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $popular_communities = Community::get();
        $member_num = [];
        foreach($popular_communities as $community){
            $member_num[] = Member::where('community_id', $community->id)->count();
        }
        
        arsort($member_num);
        // dd($member_num);
        return view('/community/popular', ['popular_communities'=>$popular_communities, 'member_num'=>$member_num]);
    }
    public function unsubscribe($community_id){
        $user_id = Auth::id();
        Member::where('community_id', $community_id)->where('user_id', $user_id)->delete();
        $member_num = Member::where('community_id', $community_id)->get();
        $is_none_member = false;
        if(empty($member_num)){
            $is_none_member = true;
        }
        return response()->json(['is_none_member'=> $is_none_member, 'community_id'=> $community_id]);
    }
    public function subscribe($community_id){
        $user_id = Auth::id();
        $user_member = Member::onlyTrashed()->where('community_id', $community_id)->where('user_id', $user_id)->first();
        if(isset($user_member)){
            Member::onlyTrashed()->where('community_id', $community_id)->where('user_id', $user_id)->restore();
        }else{
            Member::create([
                'community_id'=>$community_id,
                'user_id'=>$user_id,
                'role_type'=>0,
            ]);
        }
        return response()->json([]);
    }
}
