@extends('layouts.app')

@section('content')
<head>
    <title>人気イベント｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    人気イベント（全国）
                </div>
                <div class="card-body py-0">
                    @isset($popular_events)
                        @foreach($entry_num as $key => $value)
                            <div class="d-block col-md-12 pt-3 border-top">
                                <a href="/event/{{$popular_events[$key]->id}}" class="text-dark">
                                    <div class="row">
                                        <img src="{{$popular_events[$key]->image_path}}" alt="" class="img_xs">
                                        <div class="col-md-9 mb-0">
                                            <p class="h5 mb-0">{{$popular_events[$key]->title}}</p>
                                            <p class="mb-0">開催地　：　{{$popular_events[$key]->prefecture}}</p>
                                            <p class="mb-1">開催日時　：　{{$popular_events[$key]->start_at}}</p>
                                            <p class="text-danger mb-2">参加人数　：　{{$value}} / {{$popular_events[$key]->capacity}}</p>
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
