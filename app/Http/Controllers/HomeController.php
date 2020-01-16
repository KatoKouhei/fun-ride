<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Community;
use App\Member;
use App\Event;
use App\Entry;
use App\Follow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 参加イベント
        $user_id = Auth::id();
        $user = User::find($user_id);
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
                $event = Event::where('id', $entry->event_id)->whereDate('start_at', '>=', $dt)->first();
                if(isset($event)){
                    $events[] = $event;
                }
            }
        }
        // オススメイベント（フォローしているユーザーの参加予定イベント）
        $entries_id = Entry::where('user_id', $user_id)->select('event_id')->get();
        $follower_user_id_list = Follow::where('follow_id', $user_id)->get();
        $recommend_follower_events = [];
        foreach($follower_user_id_list as $follower){
            $follower_user = User::find($follower->follower_id);
            $follower_events_id = Entry::where('user_id', $follower->follower_id)->get();
            foreach($follower_events_id as $event_id){
                $follower_event = Event::whereNotIn('id', $entries_id)->where('id', $event_id->event_id)->where('start_at', '>=', $dt)->first();
                if(isset($follower_event)){
                    $recommend_follower_events[$follower_user->name][] = $follower_event;
                }
            }
        }

        // オススメイベント（所属グループが開催するイベント情報）
        $community_id_list = Member::where('user_id', $user_id)->get();
        $recommend_community_events = [];
        foreach($community_id_list as $member_community_id){
            $affiliation_community = Community::find($member_community_id->community_id);
            $community_events = Event::whereNotIn('id', $entries_id)->where('community_id', $member_community_id->community_id)->where('start_at', '>=', $dt)->get();
            if(isset($community_events)){
                foreach($community_events as $event){
                    $recommend_community_events[$affiliation_community->community_title][] = $event;
                }
            }
        }
        // dd($recommend_community_events);
        
        // オススメイベント（同県のイベント情報）
        $recommend = Event::where('prefecture', 'LIKE' , "%{$user->prefecture}%")->whereNotIn('id', $entries_id)->where('start_at', '>=', $dt)->get();
        // dd($recommend);
        return view('home', ['user'=>$user, 'communities'=>$communities, 'events'=>$events, 'recommend'=>$recommend, 'recommend_follower_events'=>$recommend_follower_events, 'recommend_community_events'=>$recommend_community_events]);
    }
    public function welcome()
    {
        return view('welcome');
    }

}
