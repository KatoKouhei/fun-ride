@extends('layouts.app')

@section('content')


  <div class="container">
    <div class="card border-primary mt-3">
      <div class="card-body">
        <h4 class="text-primary text-center">タイトル：{{$post->title}}</h4>
        <p class="border-bottom">走行内容</p>
        <p>{{$post->content}}</p>
        <a href="/post/delete/{{$post->id}}" type="submit" class="btn btn-primary mb-3">記事を削除</a>
      </div>
    </div>



    <form action="/comment/update/{{$comment->id}}" method="post" class="border-bottom border-dark my-5">
      @csrf
      <p class="lead">コメント編集</p>
      <div class="input-group input-group-lg mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <p class="my-auto">タイトル</p>
          </span>
        </div>
        <input type="text" name="title" id="title" class="form-control" placeholder="{{$comment->title}}">
      </div>

      <div class="input-group input-group-lg mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <p class="my-auto">コメント</p>
          </span>
        </div>
        <textarea class="form-control" rows="5" name="comment" id="comment">{{$comment->comment}}</textarea>
      </div>
      <input type="hidden" value="{{$post->id}}" name="post_id">
      <input type="submit" value="編集完了" class="btn btn-primary btn-block btn-lg mb-3">
    </form>
    

  </div>
@endsection