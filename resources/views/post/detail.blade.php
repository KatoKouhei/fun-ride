@extends('layouts.app')

@section('content')
<div class="text-center bg-light">
  <h1 class="display=1">Fan-Ride</h1>
  <p> ～個人ツーリング開催サイト～</p>
</div>

{{-- 記事詳細 --}}
<div class="bg-info py-5">
  <div class="container w-75">
    <u><p class="lead">・ 記事詳細</p></u>
    <div class="border-dark mx-auto card">
      <div class="container mr-auto mt-3">
        <div class="form-group">
          <h2><u>{{$post->title}}</u></h2>
        </div>

        <div class="form-group mt-4">
          <label style="width:20%">主催者　</label>
          <label for="gender">：</label>
          <a href="" class="">　　{{$user->name}}</a>
        </div>

        <label for="gender" class="mt-1"><u>走行内容</u></label>
        <div class="form-group">
          <label for="prefecture" style="width:20%">開催都道府県　</label>
          <label>：</label>
          <label>　　{{$post->prefecture}}</label>
        </div>
        
        <div class="form-group">
          <label for="gender" style="width:20%">走行内容　</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->load_type}}</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">走行マップ</label>
          <label for="gender">：</label>
          <a href="{{$post->map_url}}" target="_blank">　　{{$post->map_url}}</a>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">走行距離（Km）</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->distance}} ㎞</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">走行経路</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->route}}</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">集合場所</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->location}}</label>
        </div>
        <div class="form-group">
          <label for="gender" style="width:20%">集合日時</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->meeting_at}}</label>
        </div>

        <label for="gender" class="mt-5"><u>募集内容</u></label>


        <div class="form-group">
          <label for="gender" style="width:20%">走行レベル</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->level}}</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">年齢</label>
          <label for="gender">：</label>
          {{-- foreach --}}
          <label for="gender">　　{{$post->age}}</label>
          {{-- / --}}
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">開催日時</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->start_at}}</label>
        </div>
        <div class="form-group">
          <label for="gender" style="width:20%">終了日時</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->end_at}}</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">定員</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->capacity}}　人</label>
        </div>

        <div class="form-group">
          <label for="gender" style="width:20%">車種</label>
          <label for="gender">：</label>
          <label for="gender">　　{{$post->model}}</label>
        </div>


        <div class="form-group">
          <label for="gender" style="width:20%">備考欄</label>
          <label for="gender" rows="50" class="card">{{$post->detail}}</label>
        </div>

        <a href="/post/edit/{{$post->id}}" class="mx-auto btn btn-primary btn-block btn-lg mb-3 text-center w-75">記事編集</a>
        <a href="/post/delete/{{$post->id}}" class="mx-auto btn btn-primary btn-block btn-lg mb-3 text-center w-75">記事削除</a>
      </div>
    </div>
  </div>

  {{-- コメント投稿 --}}
  <div class="container w-75 mt-4">
    <label class="lead"><u>・　コメント投稿</u></label>
    <form action="/comment/store" method="post" class="border-bottom border-dark card container mb-4">
      @csrf
      <div class="form-group my-4">
        <label>タイトル</label>
        <input type="text" name="title" id="title" class="form-control">
      </div>

      <div class="form-group">
        <label>コメント</label>
        <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
      </div>
      <input type="hidden" value="{{$post->id}}" name="post_id">
      <input type="submit" value="コメントを投稿する" class="btn btn-primary btn-block btn-lg mb-3 w-75 mx-auto">
    </form>


    {{-- コメント一覧 --}}
    <label class="lead"><u>・　コメント一覧</u></label>
    @isset($comments)
      @foreach ($comments as $comment)
        <div class="card border-primary mt-3">
          <div class="card-body container mr-auto">
            <a href="">・ＵＳＥＲ名</a>
            <h4 class="mt-2">{{$comment->title}}</h4>
            <p class="border-bottom mt-3">コメント</p>
            <p class="ml-3">{{$comment->comment}}</p>
            <a href="/comment/edit/{{$comment->id}}/{{$post->id}}" class="btn btn-primary mb-3">コメント編集</a>
            <a href="/comment/delete/{{$comment->id}}/{{$post->id}}" class="btn btn-primary mb-3">コメント削除</a>
          </div>
        </div>
      @endforeach
    @endisset

  </div>
</div>
@endsection