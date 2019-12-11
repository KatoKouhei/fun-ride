@extends('layouts.app')

@section('content')
<div class="text-center bg-light">
  <h1 class="display=1">Fan-Ride</h1>
  <p> ～個人ツーリング開催サイト～</p>
</div>
<div class="bg-info py-5">
  <div class="container w-75">

    {{-- 検索 --}}
    <u><p class="lead">・ 検索と投稿</p></u>
    <form method="post" action="/post/search" class="border-dark mx-auto card">
      <div class="mx-auto mt-3">
        <div class="row mx-auto px-auto">
          <div class="form-group">
            <label for="prefecture">開催都道府県</label>
            <select class="form-control" name="prefecture" id="prefecture">
              <option value="0">選択してください</option>
              @foreach (config('prefectures') as $key => $prefecture)
                <option value="{{$key}}">{{$prefecture}}</option>
              @endforeach
            </select>
          </div>
    
          <div class="form-group">
            <label for="level">走行レベル</label>
            <select class="form-control" name="level" id="level">
              <option value="0">選択してください</option>
              @foreach (config('level') as $key => $level)
                <option value="{{$key}}">{{$level}}</option>
              @endforeach
            </select>
          </div>
    
          <div class="form-group">
            <label for="load_type">走行内容</label>
            <select class="form-control" name="load_type" id="load_type">
              <option value="0">選択してください</option>
              @foreach (config('load_type') as $key => $load_type)
                <option value="{{$key}}">{{$load_type}}</option>
              @endforeach
            </select>
          </div>
    
          <div class="form-group">
            <label for="distance">走行距離</label>
            <select class="form-control" name="distance" id="distance">
              <option value="0">選択してください</option>
              <option value="1,49">～50Km</option>
              <option value="50,99">50～100Km</option>
              <option value="100,149">100～150Km</option>
              <option value="150,199">150～200Km</option>
              <option value="200,1000">200Km～</option>
            </select>
          </div>
  
          
          <div class="form-group">
            <label for="model">車種</label>
            <select class="form-control" id="model" name="model">
              <option value="0">選択してください</option>
              @foreach (config('model') as $key => $model)
                <option value="{{$key}}">{{$model}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mx-auto">
          <div class="form-group">
            <label for="month">月</label>
            <select class="form-control" name="month" id="month">
              <option value="0">選択してください</option>
              @foreach (config('month') as $key => $month)
                <option value="{{$key}}">{{$month}}</option>
              @endforeach
            </select>
          </div>
  
          <div class="form-group">
            <label for="day">日</label>
            <select class="form-control" name="day" id="day">
              <option value="0">選択してください</option>
              @foreach (config('day') as $key => $day)
                <option value="{{$key}}">{{$day}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @csrf
        <input type="submit" value="検索" class="mx-auto btn btn-primary btn-block btn-lg mb-3 text-center w-75">
        <a href="post/create" class="mx-auto btn btn-primary btn-block btn-lg mb-3 text-center w-75">記事を投稿する（投稿画面へ移動）</a>
      </div>
    </form>

    <div class="mt-5 border-bottom border-dark"></div>

    {{-- 記事一覧 --}}
    <u><p class="lead mt-5">・　記事一覧</p></u>
    @isset($posts)
      @foreach ($posts as $post)
        <div class="card border-dark mt-3">
          <div class="card-body">
            <div class="row">
              <div class="mr-2 ml-2 text-center">
                <h4>開催日</h4>
                <p class="lead">2019年</p>
                <h5>月/日</h5>
              </div>

              <div class="border-right border-dark"></div>

              <div class="ml-3 mr-auto">
                <h4 class="border-bottom border-dark">タイトル：{{$post->title}}</h4>
                <p class="lead m">主催者：名前</p>
                <p class="lead">開催都道府県：</p>
                <p class="lead">走行内容：山岳</p>
                <p class="lead">走行マップ：URL</p>
                <p class="lead">定員：　/</p>
                <p class="lead">募集レベル：初心者</p>
                <a href="/post/detail/{{$post->id}}" class="mx-auto btn btn-primary btn-block btn-lg text-center w-75">ツーリング詳細</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endisset
  
  </div>
  
  @endsection
</div>