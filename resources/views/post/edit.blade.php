@extends('layouts.app')

@section('content')
<div class="text-center">
  <h1 class="display=1">Fan-Ride</h1>
  <p> ～個人ツーリング開催サイト～</p>
</div>
<div class="bg-light py-5">
  <div class="container">

    <form method="post" action="/post/update/{{$post->id}}" class="border-bottom border-dark">
      <p class="lead">ツーリング投稿</p>
      <div class="input-group input-group-lg mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <p class="my-auto">タイトル</p>
          </span>
        </div>
        <input type="text" name="title" id="title" class="form-control">
      </div>

      <div class="input-group input-group-lg mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <p class="my-auto">走行内容</p>
          </span>
        </div>
        <textarea class="form-control" rows="5" name="content" id="content"></textarea>
      </div>
      @csrf
      <input type="submit" value="再投稿する" class="btn btn-primary btn-block btn-lg mb-3">
    </form>
  
  </div>
  
</div>



@endsection