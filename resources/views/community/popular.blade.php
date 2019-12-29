@extends('layouts.app')

@section('content')
<head>
    <title>人気グループ｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    人気グループ（全国）
                </div>
                <div class="card-body py-0">
                    @isset($popular_communities)
                        @foreach($member_num as $key => $value)
                            <div class="d-block col-md-12 py-3 border-top">
                                <a href="/community/{{$popular_communities[$key]->id}}" class="text-dark">
                                    <div class="row">
                                        <img src="{{$popular_communities[$key]->image_path}}" alt="" class="img_xs col-md-2">
                                        <div class="col-md-9 mb-0">
                                            <p class="h5">{{$popular_communities[$key]->community_title}}</p>
                                            <p class="mb-0">{{$popular_communities[$key]->subtitle}}</p>
                                            <p class="">{{$popular_communities[$key]->community_manage}}</p>
                                            <p class="text-danger">グループ人数　：　{{$value}} 人</p>
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
