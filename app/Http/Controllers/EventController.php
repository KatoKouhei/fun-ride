<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Community;
use App\Member;
use App\Event;
use App\Entry;
use App\Blacklist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Storage;
use Carbon\Carbon;


class EventController extends Controller
{
    public function index($event_id){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $event = Event::find($event_id);
        $event->load_type = explode(',', $event->load_type);
        $load_type = null;
        foreach (config('load_type') as $key => $value) {
            if(in_array($key, $event->load_type)){
                $load_type = $load_type.$value."　";
            }
        }
        $event->load_type = $load_type;
        $event->level = explode(',', $event->level);
        $level = null;
        foreach (config('level') as $key => $value) {
            if(in_array($key, $event->level)){
                $level = $level.$value."　";
            }
        }
        $event->level = $level;
        $Parsedown = new \Parsedown();
        $event->description = $Parsedown->text($event->description);
        $event_num = Event::where('community_id', $event->community_id)->get();
        $event_num = count($event_num);
        $entry_num = Entry::where('event_id', $event_id)->get();
        $entry_num = count($entry_num);
        $community = Community::find($event->community_id);
        // dd($community);
        // dd($community->id);
        $entry = [];
        $community_member = [];
        $community_member_num = [];
        if(isset($community)){
            $community_member = Member::where('community_id', $community->id)->get();
            $community_member_num = count($community_member);
            $entry = Entry::where('event_id',$event_id)->where('user_id', $user_id)->first();
        };

        $entry_0 = Entry::where('event_id', $event_id)->where('role_type', '0')->get();
        $user_0 = [];
        foreach($entry_0 as $entry){
            $user_0[] = User::find($entry->user_id);
        }
        $entry_1 = Entry::where('event_id', $event_id)->where('role_type', '1')->get();
        $user_1 = [];
        foreach($entry_1 as $entry){
            $user_1[] = User::find($entry->user_id);
        }
        $entry_user = Entry::where('event_id', $event_id)->where('user_id', $user_id)->first();
        $black_holder = null;
        if(isset($community)){
            $black_user = BlackList::where('community_id', $community->id)->where('user_id', $user_id)->first();
            $black_holder = false;
            if(isset($black_user)){
                $black_holder = true;
            }
        }
        return view('event/index', ['user'=>$user, 'event'=>$event, 'community'=>$community ,'entry'=>$entry, 'event_num'=>$event_num, 'community_member_num'=>$community_member_num, 'entry_num'=>$entry_num, 'user_0'=>$user_0, 'user_1'=>$user_1, 'entry_user'=>$entry_user, 'black_holder'=>$black_holder]);
    }
    // public function index(){
    //     $user_id = Auth::id();
    //     return view('event/index');
    // }
    public function edit($event_id){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $event = Event::where('id', $event_id)->first();
        $event->load_type = explode(',', $event->load_type);
        $event->level = explode(',', $event->level);
        $member_array = Member::where('user_id', $user_id)->where('role_type', '1')->get();
        $communities = [];
        foreach ($member_array as $key => $member) {
            $communities[] = Community::find($member->community_id);
        }
        return view('event/edit', ['event'=>$event, 'user'=>$user, 'communities'=>$communities]);
    }
    public function update(Request $request){
        $request->validate([
            'image_path' => ['image'],
            'title' => ['required', 'string', 'max:255',],
            'prefecture' => ['required', 'string', 'max:255',],
            'start_at' => ['required',],
            'capacity' => ['required',],
        ]);
        $event_id = $request->event_id;
        $event = Event::find($event_id);
        $event->community_id = $request->community_id;
        $event->title = $request->title;
        $event->subtitle = $request->subtitle;
        if(isset($request->image_path)){
            $path = Storage::disk('s3')->putFile('fanride', $request->image_path, 'public');
            $event->image_path = Storage::disk('s3')->url($path);
        }
        $event->description = $request->description;
        $event->map_url = $request->map_url;
        $event->prefecture = $request->prefecture;
        $event->route = $request->route;
        if(isset($request->load_type)){
            $event->load_type = implode(',', $request->load_type);
        }
        if(isset($request->level)){
            $event->level = implode(',', $request->level);
        }
        $event->distance = $request->distance;
        $event->location = $request->location;
        $event->start_at = $request->start_at;
        $event->end_at = $request->end_at;
        $event->meeting_at = $request->meeting_at;
        $event->capacity = $request->capacity;
        $event->save();
        return redirect("event/$event_id");
    }
    public function register(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $member_array = Member::where('user_id', $user_id)->where('role_type', '1')->get();
        $communities = [];
        $is_hold_community_role_1 = false;
        // dd($member_array);
        if(empty($member_array) == false){
            foreach ($member_array as $key => $member) {
                $communities[] = Community::find($member->community_id);
            }
            $is_hold_community_role_1 = true;
        }
        // dd($is_hold_community_role_1);
        return view('event/register', ['communities'=>$communities, 'user'=>$user, 'is_hold_community_role_1'=>$is_hold_community_role_1]);
    }
    public function copiRegister($event_id){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $member_array = Member::where('user_id', $user_id)->where('role_type', '1')->get();
        $communities = [];
        if(isset($member_array)){
            foreach ($member_array as $key => $member) {
                $communities[$key] = Community::find($member->community_id);
            }
        }
        $event = Event::find($event_id);
        $event->load_type = explode(',', $event->load_type);
        $event->level = explode(',', $event->level);
        return view('event/copiRegister', ['communities'=>$communities, 'user'=>$user, 'event'=>$event]);
    }
    public function create(Request $request){
        $request->validate([
            'image_path' => ['image'],
            'title' => ['required', 'string', 'max:255',],
            'prefecture' => ['required', 'string', 'max:255',],
            'start_at' => ['required',],
            'capacity' => ['required',],
            ]);
        $user_id = Auth::id();
        $user = User::find($user_id);
        $community_id = $request->community_id;
        $title = $request->title;
        $subtitle = $request->subtitle;
        if(isset($request->image_path)){
            $path = Storage::disk('s3')->putFile('fanride', $request->image_path, 'public');
            $image_path = Storage::disk('s3')->url($path);
        }else{
            $image_path = $request->image_path;
        }
        $description = $request->description;
        $map_url = $request->map_url;
        $prefecture = $request->prefecture;
        $route = $request->route;
        $distance = $request->distance;
        $load_type = $request->load_type;
        if(isset($load_type)){
            $load_type = implode(',', $load_type);
        }
        $level = $request->level;
        if(isset($level)){
            $level = implode(',', $level);
        }
        $location = $request->location;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $meeting_at = $request->meeting_at;
        $capacity = $request->capacity;
        Event::create([
            'title'=>$title,
            'subtitle'=>$subtitle,
            'community_id'=>$community_id,
            'image_path'=>$image_path,
            'description'=>$description,
            'map_url'=>$map_url,
            'prefecture'=>$prefecture,
            'route'=>$route,
            'load_type'=>$load_type,
            'distance'=>$distance,
            'level'=>$level,
            'location'=>$location,
            'start_at'=>$start_at,
            'end_at'=>$end_at,
            'meeting_at'=>$meeting_at,
            'capacity'=>$capacity,
        ]);
        
        $today = Carbon::now()->toDateString();
        $event = Event::where('community_id', $community_id)->where('title', $title)->where('prefecture', $prefecture)->where('capacity', $capacity)->whereDate('created_at', '=', $today)->first();
        $role_type = '1';
        Entry::create([
            'event_id'=>$event->id,
            'user_id'=>$user_id,
            'role_type'=>$role_type,
        ]);
        return redirect("event/$event->id");
    }
    public function management(){
        $user_id = Auth::id();
        $entry_num = Entry::where('user_id', $user_id)->where('role_type', '1')->get();
        $event_num = [];
        $today = Carbon::today();
        foreach($entry_num as $entry){
            $event = Event::where('id', $entry->event_id)->whereDate('start_at', '>=', $today)->first();
            if(isset($event)){
                $event_num[] = $event;
            }
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
    public function delete($event_id){
        Event::find($event_id)->delete();
        Entry::where('event_id', $event_id)->delete();
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
        $dt = Carbon::now();
        $prefecture = config('prefecture')[$user->prefecture];
        $new_events = Event::where('prefecture', 'LIKE', "%$prefecture%")->where('start_at', '>=', $dt)->get();
        return view('/event/new', ['new_events'=>$new_events]);
    }
    public function popular(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        $dt = Carbon::now();
        $popular_events = Event::where('start_at', '>=', $dt)->get();
        foreach($popular_events as $key => $event){
            $entry_num[$key] = Entry::where('event_id', $event->id)->count();
        }
        arsort($entry_num);
        return view('/event/popular', ['popular_events'=>$popular_events, 'entry_num'=>$entry_num]);
    }
    public function unsubscribe($event_id){
        $user_id = Auth::id();
        Entry::where('event_id', $event_id)->where('user_id', $user_id)->delete();
        $entry_num = Entry::where('event_id', $event_id)->get();
        $is_none_entry = false;
        if(empty($entry_num)){
            $is_none_entry = true;
        }
        return response()->json(['is_none_entry'=> $is_none_entry, 'event_id'=> $event_id]);
    }
    public function subscribe($event_id){
        $user_id = Auth::id();
        $user_entry = Entry::onlyTrashed()->where('event_id', $event_id)->where('user_id', $user_id)->first();
        $is_none_entry = false;
        if($user_entry == null){
            $is_none_entry = true;
            Entry::create([
                'event_id'=>$event_id,
                'user_id'=>$user_id,
                'role_type'=>0,
                ]);
        }else{
            Entry::onlyTrashed()->where('event_id', $event_id)->where('user_id', $user_id)->restore();
        }
        return response()->json(['is_none_entry'=>$is_none_entry]);
    }
    public function search(Request $request){
        $keyword = $request->keyword;
        $today = Carbon::today();
        $add_15day = $today->copy()->addDays(15);
        $result = Event::whereDate('start_at', '>=', $today);
        // dd($keyword);
        if(isset($keyword)){
            $keyword = explode(' ', $keyword);
            // dd($keyword);
            foreach($keyword as $word){
                // dd($word);
                    $result->where(function($q) use ($word) {
                        // dd($word);
                        $q->where('title', 'LIKE', "%$word%")->orwhere('subtitle', 'LIKE', "%$word%")->orwhere('prefecture', 'LIKE', "%$word%")->orwhere('description', 'LIKE', "%$word%");
                    });
            }
        }
        $result = $result->get();
        // dd($result);
        $today = $today->toDateString();
        $add_15day = $add_15day->toDateString();
        return view('/event/search', ['result'=> $result, 'today'=> $today, 'add_15day'=> $add_15day]);
    }
    public function research(Request $request){
        $keyword = $request->keyword;
        $start_at_1 = $request->start_at_1;
        $start_at_2 = $request->start_at_2;
        $distance1 = $request->distance1;
        $distance2 = $request->distance2;
        $load_type = $request->load_type;
        $level = $request->level;
        $today = Carbon::today();
        $result = Event::whereDate('start_at', '>=', $today);
        if(isset($keyword)){
            $keyword = explode(' ', $keyword);
            // dd($keyword);
            foreach($keyword as $word){
                // dd($word);
                    $result->where(function($q) use ($word) {
                        // dd($word);
                        $q->where('title', 'LIKE', "%$word%")->orwhere('subtitle', 'LIKE', "%$word%")->orwhere('prefecture', 'LIKE', "%$word%")->orwhere('description', 'LIKE', "%$word%");
                    });
            }
        }
        if(isset($distance1)){
            $result = $result->orwhere('distance', '>=', $distance1);
        }
        if(isset($distance2)){
            $result = $result->orwhere('distance', '<=', $distance2);
        }
        if(isset($start_at_1)){
            $result = $result->orwhereDate('start_at', '>=', $start_at_1)->get();
            // dd($start_at_1);
        }
        if(isset($start_at_2)){
            $result = $result->orwhereDate('start_at', '<=', $start_at_2);
        }
        if(isset($load_type)){
            foreach($load_type as $value){
                $result = $result->orwhere('load_type', 'LIKE' ,"%{$value}%");
            }
        }
        if(isset($level)){
            foreach($level as $value){
                $result = $result->orwhere('level', 'LIKE' ,"%{$value}%");
            }
        }
        $result = $result->get();
        // dd($result);
        $add_15day = $today->copy()->addDays(15);
        $today = $today->toDateString();
        // dd($today);
        $add_15day = $add_15day->toDateString();
        return view('/event/search', ['result'=>$result,'today'=>$today, 'add_15day'=>$add_15day]);
    }
}
