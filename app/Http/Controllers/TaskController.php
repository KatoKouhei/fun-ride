<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;
use App\User;
use App\Entry;
use App\Member;
use App\Follow;
use App\Community;
use Illuminate\Support\Facades\Mail;
use App\Mail\FollowUp;
use App\Mail\GroupUp;
use App\Mail\Reminder;
use App\Mail\Suspension;

class TaskController extends Controller
{
    // フォローしている人が参加するイベントを通知
    public static function followUp(){
        $entry_day = Carbon::yesterday();
        $followers = Entry::whereDate('created_at', $entry_day)->get();
        if(isset($followers)){
            foreach($followers as $follower){
                $follower_data = User::find($follower->user_id);
                $event = Event::find($follower->event_id);
                $follows = Follow::where('follower_id', $follower->user_id)->get();
                if(isset($follows)){
                    foreach($follows as $follow){
                        $user = User::find($follow->follow_id);
                        $mail_preference = explode(',', $user->mail_preference);
                        if(in_array('3', $mail_preference)){
                            $name = $user->name;
                            $to = $user->email;
                            $with = [
                                'event' => $event,
                                'follower_data' => $follower_data,
                                'name' => $name,
                            ];
                            Mail::to($to)
                                ->send(new followUp($with));
                        }
                    }
                }
            }
        }
    }

    // 参加していたイベントが中止したとき
    public static function suspension(){
        $deleted_at = Carbon::yesterday();
        $call_events = Event::onlyTrashed()->whereDate('deleted_at', $deleted_at)->get();
        if(isset($call_events)){
            foreach ($call_events as $event){
                $users_id = Entry::onlyTrashed()->where('event_id', $event->id)->get();
                foreach ($users_id as $user_id){
                    $user = User::find($user_id->user_id);
                    $mail_preference = explode(',', $user->mail_preference);
                    if(in_array('9', $mail_preference)){
                        $name = $user->name;
                        $to = $user->email;
                        $with = [
                            'event' => $event,
                            'name' => $name,
                        ];
                        Mail::to($to)
                            ->send(new Suspension($with));
                    }
                }
            }
        }
    }

    // 参加イベントのリマインダー
    public static function reminder(){
        $event_day = Carbon::tomorrow();
        $call_events = Event::whereDate('start_at', $event_day)->get();
        if(isset($call_events)){
            foreach ($call_events as $event){
                $users_id = Entry::where('event_id', $event->id)->get();
                foreach ($users_id as $user_id){
                    $user = User::find($user_id->user_id);
                    $mail_preference = explode(',', $user->mail_preference);
                    if(in_array('9', $mail_preference)){
                        $name = $user->name;
                        $to = $user->email;
                        $with = [
                            'event' => $event,
                            'name' => $name,
                        ];
                        Mail::to($to)
                            ->send(new Reminder($with));
                    }
                }
            }
        }
    }

    // 参加グループのイベントが公開されたとき
    public static function groupUp(){
        $up_day = Carbon::yesterday();
        $call_events = Event::whereDate('created_at', '=', $up_day)->get();
        if(isset($call_events)){
            foreach($call_events as $event){
                $users_id = Member::where('community_id', $event->community_id)->get();
                $community = Community::find($event->community_id);
                foreach($users_id as $user_id){
                    $user = User::find($user_id->user_id);
                    $mail_preference = explode(',', $user->mail_preference);
                    if(in_array('11', $mail_preference)){
                        $name = $user->name;
                        $to = $user->email;
                        $with = [
                            'event' => $event,
                            'community' => $community,
                            'name' => $name,
                        ];
                        Mail::to($to)
                            ->send(new GroupUp($with));
                    }
                }
            }
        }

    }
}
