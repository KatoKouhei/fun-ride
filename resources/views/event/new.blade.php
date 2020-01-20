@extends('layouts.app')

@section('content')
<head>
    <title>新着イベント｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row">
        <div class="col-md-9 mb-4">
            <div class="card">
                <div class="card-header">
                    新着イベント（ユーザーと同じ県で開催される新着イベント）
                </div>
                <div class="card-body py-0">
                    @isset($new_events)
                        @foreach($new_events as $event)
                            <div class="d-block col-md-12 py-3 border-top">
                                <a href="/event/{{$event->id}}" class="text-dark">
                                    <div class="row">
                                        <img src="{{$event->image_path}}" alt="" class="img_xs">
                                        <div class="col-md-8 mb-0">
                                            <p class="h5">{{$event->title}}</p>
                                            <p class="mb-0">開催地　：　{{$event->prefecture}}</p>
                                            <p class="">開催日時　：　{{$event->start_at}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded bg-white font-weight-bold">
                <a class="nav-link text-dark" href="/event/new">・新着イベント</a>
                <a class="nav-link text-dark" href="/community/new">・新着グループ</a>
                <a class="nav-link text-dark" href="/event/popular">・イベントランキング</a>
                <a class="nav-link text-dark" href="/community/popular">・グループランキング</a>
            </div>
        </div>
    </div>
</div>

@endsection
