@extends('layouts.app')

@section('content')
<head>
    <title>USER情報｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="mb-4">
                <div class="mb-3 border-bottom border-orange mx-1">
                    <div id="">
                        <h3 class="d-inline-block">{{$user->name}}</h3>
                        <div id="follow_button" class="d-inline-block float-right">
                            @if($my_user_id !== $user->id)
                                @if(empty($follow))
                                    <button class="btn btn-orange border-dark py-1 mx-2 d-inline-block float-right" onclick="follow()" name="" id="" value="">フォローする</button>
                                @else
                                    <button class="btn btn-defalte border-dark py-1 mx-2 d-inline-block float-right" onclick="unfollow()" name="" id="" value="">フォロー解除</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card my-4">
                    <div class="card-header">
                        プロフィール
                    </div>
                    <div class="card-body container">
                        <p>・都道府県  :  {{$user->prefecture}}</p>
                        <p>・脚質  :  {{$user->ride_type}}</p>
                        <p>・自己紹介</p>
                        <div class="m-0 ml-3 container">
                            {!! nl2br(e( $user->profile )) !!}
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        所属グループ
                    </div>
                    <div class="card-body p-0 m-0 row">
                        @if(isset($communities))
                            @foreach($communities as $community)
                                <div class="d-block col-md-12 py-3 border-top">
                                    <a href="/community/{{$community->id}}" class="text-dark">
                                        <div class="row">
                                            <img src="{{$community->image_path}}" alt="" class="img_xs">
                                            <div class="col-md-8 mb-0">
                                                <p class="h5">{{$community->community_title}}</p>
                                                <p class="mb-0">{{$community->community_subtitle}}</p>
                                                <p class="">{{$community->community_manege}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            管理、メンバーになっているグループはありません
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="">
                            <button class="btn btn-info border-dark float-right d-inline-block" onclick="location.href='community/register'">グループを作成する</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row align-items-stretch text-center">
                    <div class="port-item p-4 bg-orange border w-50" data-toggle="collapse" data-target="#home">
                        <span class="d-sm-block font-weight-bold">参加イベント</span>
                    </div>
                    <div class="port-item p-4 bg-info border w-50" data-toggle="collapse" data-target="#resume">
                        <span class="d-sm-block font-weight-bold">管理イベント</span>
                    </div>
                </div>

                <div id="home" class="collapse" style="">
                    <div class="card card-body bg-orange">
                        <p class="my-auto h5 font-weight-bold">参加イベント</p>
                        @if(isset($events))
                            @foreach($events as $event)
                                <div class="d-block col-md-12 py-3 border-top">
                                    <a href="/event/{{$event->id}}" class="text-dark">
                                        <div class="row">
                                            <img src="{{$event->image_path}}" alt="" class="img_xs">
                                            <div class="col-md-8 mb-0">
                                                <p class="h5">{{$event->title}}</p>
                                                <p class="mb-0">開催地　：　{{$event->prefecture}}</p>
                                                <p class="font-weight-bold text-danger"><u>開催日時　：　{{$event->start_at}}</u></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            参加するイベントがありません
                        @endif
                    </div>
                </div>
                
                <div id="resume" class="collapse" style="">
                    <div class="card card-body bg-info">
                        <p class="h5 my-auto text-right font-weight-bold">管理イベント</p>
                        @if(isset($events_1))
                            @foreach($events_1 as $event)
                                <div class="d-block col-md-12 py-3 border-top">
                                    <a href="/event/{{$event->id}}" class="text-dark">
                                        <div class="row">
                                            <img src="{{$event->image_path}}" alt="" class="img_xs">
                                            <div class="col-md-8 mb-0">
                                                <p class="h5">{{$event->title}}</p>
                                                <p class="mb-0">開催地　：　{{$event->prefecture}}</p>
                                                <p class="font-weight-bold text-danger"><u>開催日時　：　{{$event->start_at}}</u></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            管理、メンバーになっているグループはありません
                        @endif
                    </div>
                </div>

                
            </div>
            
        </div>
        <div class="col-sm-4">
            <div class="">
                <div class="card mb-4">
                    <div class="card-header">
                        プロフィール画像
                    </div>
                    <div class="card-body p-0 mx-auto">
                        <img src="{{$user->image_path}}" alt="" width="283" height="" class="img_profile col-md-12">
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        フォロー
                    </div>
                    <div class="card-body">
                        <div class="">
                            @isset($follow_user)
                                @foreach($follow_user as $follow_user)
                                    <div>
                                        <a href="/user/{{$follow_user->id}}">
                                            <img src="{{$follow_user->image_path}}" alt="" class="img_follow">
                                            <label for="">{{$follow_user->name}}</label>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        フォロワー
                    </div>
                    <div class="card-body">
                        <div class="">
                            @isset($follower_user)
                                @foreach($follower_user as $follower_user)
                                    <div class="">
                                        <a href="/user/{{$follower_user->id}}">
                                            <img src="{{$follower_user->image_path}}" alt="" class="img_follow">
                                            <label for="">{{$follower_user->name}}</label>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // followする
    function follow() {
        console.log("{{$user->id}}")
        fetch("{{ url("/follow/$user->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
            alert("{{$user->name}}" + 'さんをフォローしました');
            // TODO:リダイレクトさせる
            $('#follow_button').html(`
                <button class="btn btn-defalte border-dark float-right clearfix py-1 mx-2 d-inline-block" onclick="unfollow()" name="unfollow" id="unfollow" value="unfollow">フォロー解除</button>
            `);
            
        })
        .catch((err) => console.error(err));
    }
    // follow解除
    function unfollow() {
        fetch("{{ url("/unfollow/$user->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
            alert("{{$user->name}}" + 'さんのフォローを解除しました');
            // TODO:リダイレクトさせる
            $('#follow_button').html(`
                <button class="btn btn-orange border-dark float-right py-1 mx-2 clearfix d-inline-block" onclick="follow()" name="follow" id="follow" value="follow">フォローする</button>
            `);
            
        })
        .catch((err) => console.error(err));
    }
</script>
@endsection