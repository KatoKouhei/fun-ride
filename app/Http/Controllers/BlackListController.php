<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Community;
use App\Blacklist;

class BlackListController extends Controller
{
    public function index($community_id){
        $community = Community::find($community_id);
        $blackList_user_id = BlackList::where('community_id', $community_id)->get();
        $blackList_user = [];
        foreach($blackList_user_id as $list){
            $blackList_user[] = User::find($list->user_id);
        }
        return view('blackList/index', (['community'=>$community, 'blackList_user'=>$blackList_user]));
    }
    public function create(Request $request){
        $community = Community::find($request->community_id);
        $user = User::where('name', $request->user_name)->first();
        if(isset($user)){
            BlackList::create([
                'community_id'=>$community->id,
                'user_id'=>$user->id,
            ]);
        }
        return redirect("blackList/$community->id");
    }
    public function delete(Request $request){
        $community = Community::find($request->community_id);
        $user = User::find($request->user_id);
        BlackList::where('community_id', $community->id)->where('user_id', $user->id)->delete();
        $blackList_user_id = BlackList::where('community_id', $community->id)->get();
        $blackList_user = [];
        foreach($blackList_user_id as $list){
            $blackList_user[] = User::find($list->user_id);
        }
        return view('blackList/index', (['community'=>$community, 'blackList_user'=>$blackList_user]));
    }
}
