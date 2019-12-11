<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class PostController extends Controller
{
    /**
     * 投稿ページトップ
     */
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('post/index', ['posts' => $posts]);
    }

    /**
     * 投稿画面へ移動
     */
    public function create(Request $request){
        // $user_id = Auth::id();
        // dd($user_id);
        return view('post/create');
    }

    /**
     * 投稿する
     */
    public function store(Request $request){
        $title = $request->title;
        $prefecture = $request->prefecture;
        $load_type = $request->load_type;
        $load_type = implode(",", $load_type);
        $map_url = $request->map_url;
        $distance = $request->distance;
        $route = $request->route;
        $location = $request->location;
        $meeting_at = $request->meeting_at;
        $level = $request->level;
        $level = implode(",", $level);
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $capacity = $request->capacity;
        $model = $request->model;
        $model = implode(",", $model);
        $age = $request->age;
        $age = implode(",", $age);
        // dd($age);
        $detail = $request->detail;
        $user_id = Auth::id();
        Post::create([
            'title'=>$title,
            'prefecture'=>$prefecture,
            'load_type'=>$load_type,
            'map_url'=>$map_url,
            'distance'=>$distance,
            'route'=>$route,
            'location'=>$location,
            'meeting_at'=>$meeting_at,
            'level'=>$level,
            'start_at'=>$start_at,
            'end_at'=>$end_at,
            'capacity'=>$capacity,
            'model'=>$model,
            'age'=>$age,
            'detail'=>$detail,
            'user_id'=>$user_id
        ]);
        return redirect('/post');
    }

    /**
     * 投稿ページ詳細
     */
    public function detail($post_id){
        $post = Post::find($post_id);
        $post->load_type = explode(",", $post->load_type);
        foreach($post->load_type as $key => $value){
            $load_type[] = config("load_type.$value");
        }
        $post->load_type = implode("/ ",$load_type);
        $post->level = explode(",", $post->level);
        foreach($post->level as $key => $value){
            $level[] = config("level.$value");
        }
        $post->level = implode("/ ", $level);
        $post->age = explode(",", $post->age);
        foreach($post->age as $key => $value){
            $age[] = config("age.$value");
        }
        $post->age = implode("/ ", $age);
        $post->model = explode(",", $post->model);
        foreach($post->model as $key => $value){
            $model[] = config ("model.$value");
        }
        $post->model = implode("/ ", $model);
        $post->prefecture = config("prefectures.$post->prefecture");
        $user = User::find($post->user_id);
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        // dd($user->name);
        return view('post/detail', ['post' => $post, 'comments'=> $comments, 'user' => $user]);
    }

    /**
     * 投稿記事削除
     */
    public function delete($post_id){
        // dd($post_id);
        Post::find($post_id)->delete();
        $comments = Comment::find($post_id);
        if(isset($comments) !== false){
            Comment::find($post_id)->delete();
        }
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('post/index', ['posts' => $posts]);
    }

    /**
     * 投稿記事編集と再投稿
     */
    public function edit($post_id){
        $post = Post::find($post_id);
        $user_id = Auth::id();
        if($user_id == $post->user_id){
            return view("post/edit", ["post" => $post]);
        }else{
            $posts = Post::orderBy('created_at', 'desc')->get();
            return view('post/index', ['posts' => $posts]);
        }
    }
    public function update(Request $request){
        $title = $request->title;
        $content = $request->content;
        $user_id = Auth::id();
        $post_id = $request->post_id;
        Post::find($post_id)->update(['title'=>$title, 'content'=>$content, 'user_id'=>$user_id, 'id'=>$post_id]);
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('post/index', ['posts' => $posts]);
    }

    public function search(Request $request){
        $prefecture = $request->prefecture;
        $level = $request->level;
        $load_type = $request->load_type;
        $distance = explode(",", $request->distance);
        $model = $request->model;
        $month = $request->month;
        $day = $request->day;
        $query = Post::orderBy('created_at', 'desc');
        // dd($query);
        if($prefecture > 0){
            $query = $query -> where('prefecture', $prefecture);
        }
        if($level > 0){
            $query = $query -> where('level', 'like', "%{$level}%");
            // dd($level);
            // dd($query);
        }
        if($load_type > 0){
            $query = $query -> where('load_type', 'like', "%{$load_type}%");
        }
        if($distance[0] > 0){
            $query = $query -> where('distance', ">=",$distance[0]) -> where('distance', "<=", $distance[1]);
        }
        if($model > 0){
            $query = $query -> where('model', 'like', "%{$model}%");
        }
        if($month > 0){

            $query = $query -> where('month', $month);

        }
        if($day > 0){
            $query = $query -> where('day', $day);
        }
        $query = $query -> get();
        // dd($query);
        return view('post/index', ['posts' => $query]);
    }
}
