<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメント投稿
     */
    public function store(Request $request){
        $title = $request->title;
        $comment = $request->comment;
        $post_id = $request->post_id;
        $user_id = Auth::id();
        Comment::create(['title'=>$title, 'comment'=>$comment, 'post_id'=>$post_id, 'user_id'=>$user_id]);
        return redirect("/post/detail/$post_id");
    }

    /**
     * コメント削除
     */
    public function delete(Request $request){
      $post_id = $request->post_id;
      $post = Post::find($post_id);
      $comment_id = $request->comment_id;
      $comment = Comment::find($comment_id);
      $user_id = Auth::id();
      if($user_id == $comment->user_id){
        Comment::find($comment_id)->delete();
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        return view('post/detail', ['post' => $post, 'comments' => $comments]);
      }else{
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        return view('post/detail', ['post' => $post, 'comments' => $comments]);
      }
    }

    /**
     * コメント編集と再投稿
     */
    public function edit(Request $request){
      $comment_id = $request->comment_id;
      $comment = Comment::find($comment_id);
      $post_id = $request->post_id;
      $post = Post::find($post_id);
      $user_id = Auth::id();
      // dd($comment);
      if($user_id == $comment->user_id){
        return view('comment/edit', ['post' => $post, 'comment' => $comment]);
      }else{
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        return view('post/detail', ['post' => $post, 'comments' => $comments]);
      }
    }
    public function update(Request $request){
      $comment_id = $request->comment_id;
      $title = $request->title;
      $comment = $request->comment;
      $post_id = $request->post_id;
      $user_id = Auth::id();
      if(isset($title) == false  || isset($comment) == false){
        return redirect("/post/detail/$post_id");
      }else{
        Comment::find($comment_id)->update(['title'=>$title, 'comment'=>$comment, 'post_id'=>$post_id, 'user_id'=>$user_id, 'id' => $comment_id]);
        return redirect("/post/detail/$post_id");
      }
    }

}
