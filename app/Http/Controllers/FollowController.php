<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;

class FollowController extends Controller
{
    public function follow($user_id){
        $my_user_id = Auth::id();
        $my_user = User::find($my_user_id);
        $user = User::find($user_id);
        $user_follow = Follow::onlyTrashed()->where('follow_id', $my_user_id)->where('follower_id', $user_id)->first();
        if(isset($user_follow)){
            Follow::onlyTrashed()->where('follow_id', $my_user_id)->where('follower_id', $user_id)->restore();
        }else{
            Follow::create([
                'follow_id'=>$my_user_id,
                'follower_id'=>$user_id,
            ]);
        }
        return response()->json(['user'=>$user]);
    }
    public function unfollow($user_id){
        $my_user_id = Auth::id();
        $my_user = User::find($my_user_id);
        Follow::onlyTrashed()->where('follow_id', $my_user_id)->where('follower_id', $user_id)->delete();
        return response()->json([]);
    }
}
