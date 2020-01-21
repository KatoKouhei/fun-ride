<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Entry;
use App\Member;
use App\Community;


class AddAdministratorController extends Controller
{
    public function index($community_id){
        $community = Community::find($community_id);
        $member_1 = Member::where('community_id', $community_id)->where('role_type', 1)->get();
        $addministrator_user = [];
        foreach($member_1 as $list){
            $addministrator_user[] = User::find($list->user_id);
        }
        // dd($addministrator_user);
        return view('addAdministrator/index', ['community'=>$community, 'addministrator_user'=>$addministrator_user]);
    }
    public function create(Request $request){
        $community = Community::find($request->community_id);
        $user = User::where('name', $request->user_name)->first();
        if(isset($user)){
            $lost_member_1 = Member::onlyTrashed()->where('community_id', $community->id)->where('user_id', $user->id)->where('role_type', 1)->first();
            if(isset($lost_member_1)){
                $lost_member_1 -> restore();
                $member_0 = Member::where('community_id', $community->id)->where('user_id', $user->id)->where('role_type', 0)->first();
                if(isset($member_0)){
                    Member::where('user_id', $user->id)->where('role_type', 0)->delete();
                }
            }else{
                Member::create([
                    'community_id'=>$community->id,
                    'user_id'=>$user->id,
                    'role_type'=> 1,
                ]);
                $member_0 = Member::where('community_id', $community->id)->where('user_id', $user->id)->where('role_type', 0)->first();
                if(isset($member_0)){
                    Member::where('user_id', $user->id)->where('role_type', 0)->delete();
                }
            }
        }
        return redirect("addAdministrator/$community->id");
    }
    public function delete(Request $request){
        $community = Community::find($request->community_id);
        $user = User::find($request->user_id);
        Member::where('community_id', $community->id)->where('user_id', $user->id)->where('role_type', 1)->delete();
        $lost_member_0 = Member::onlyTrashed()->where('community_id', $community->id)->where('user_id', $user->id)->where('role_type', 0)->first();
        if(isset($lost_member_0)){
            $lost_member_0 -> restore();
        }else{
            Member::create([
                'community_id'=>$community->id,
                'user_id'=>$user->id,
                'role_type'=> 0,
            ]);
        }
        $member_1 = Member::where('community_id', $community->id)->where('role_type', 1)->get();
        $addministrator_user = [];
        foreach($member_1 as $list){
            $addministrator_user[] = User::find($list->user_id);
        }
        // dd($addministrator_user);
        return view('addAdministrator/index', ['community'=>$community, 'addministrator_user'=>$addministrator_user]);
    }
    public function eventIndex($event_id){
        $event = Event::find($event_id);
        $entry_1 = Entry::where('event_id', $event_id)->where('role_type', 1)->get();
        $addministrator_user = [];
        foreach($entry_1 as $list){
            $addministrator_user[] = User::find($list->user_id);
        }
        // dd($addministrator_user);
        return view('addAdministrator/eventIndex', ['event'=>$event, 'addministrator_user'=>$addministrator_user]);
    }
    public function eventCreate(Request $request){
        $event = Event::find($request->event_id);
        $user = User::where('name', $request->user_name)->first();
        if(isset($user)){
            $lost_entry_1 = Entry::onlyTrashed()->where('event_id', $event->id)->where('user_id', $user->id)->where('role_type', 1)->first();
            if(isset($lost_entry_1)){
                $lost_entry_1 -> restore();
                $entry_0 = Entry::where('event_id', $event->id)->where('user_id', $user->id)->where('role_type', 0)->first();
                if(isset($entry_0)){
                    $entry_0 -> delete();
                }
            }else{
                Entry::create([
                    'event_id'=>$event->id,
                    'user_id'=>$user->id,
                    'role_type'=> 1,
                ]);
                $entry_0 = Entry::where('event_id', $event->id)->where('user_id', $user->id)->where('role_type', 0)->first();
                if(isset($entry_0)){
                    $entry_0 -> delete();
                }
            }
        }
        return redirect("addAdministrator/event/$event->id");
    }
    public function eventDelete(Request $request){
        $event = Event::find($request->event_id);
        $user = User::find($request->user_id);
        Entry::where('event_id', $event->id)->where('user_id', $user->id)->where('role_type', 1)->delete();
        $lost_entry_0 = Entry::onlyTrashed()->where('event_id', $event->id)->where('user_id', $user->id)->where('role_type', 0)->first();
        if(isset($lost_entry_0)){
            $lost_entry_0 -> restore();
        }else{
            Entry::create([
                'event_id'=>$event->id,
                'user_id'=>$user->id,
                'role_type'=> 0,
            ]);
        }
        $Entry_1 = Entry::where('event_id', $event->id)->where('role_type', 1)->get();
        $addministrator_user = [];
        foreach($Entry_1 as $list){
            $addministrator_user[] = User::find($list->user_id);
        }
        // dd($addministrator_user);
        return view('addAdministrator/eventIndex', ['event'=>$event, 'addministrator_user'=>$addministrator_user]);
    }
}