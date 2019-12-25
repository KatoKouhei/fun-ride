@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-md-8">
            <div class="border-bottom border-orange">
                <h3 class="d-inline-block">{{$user->name}}</h3>
                <button class="btn btn-default border-dark py-1 mx-2 d-inline-block float-right" onclick="location.href='/user/edit'">
                    プロフィールを変更
                </button>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    あなたのイベント
                </div>
                <div class="card-boby">
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
                        管理、メンバーになっているグループはありません
                    @endif
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    所属グループ
                </div>
                <div class="card-boby">
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
                    <button class="btn btn-info border-dark float-right" onclick="location.href='/community/register'">
                        グループを作成
                    </button>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    おすすめイベント
                </div>
                <div class="card-boby recommend-event">
                    @if(isset($recommend_follower_events))
                        @foreach($recommend_follower_events as $key => $value)
                            @foreach($recommend_follower_events[$key] as $follower_event)
                                <div class="d-block col-md-12 py-3 border-top">
                                    <p class="h5 border-bottom border-orange"><strong class="text-danger">「{{$key}}」</strong>さんが参加予定のイベント</p>
                                    <a href="/event/{{$follower_event->id}}" class="text-dark">
                                        <div class="row">
                                            <img src="{{$follower_event->image_path}}" alt="" class="img_xs">
                                            <div class="col-md-8 mb-0">
                                                <p class="h5">{{$follower_event->title}}</p>
                                                <p class="mb-0">開催地　：　{{$follower_event->prefecture}}</p>
                                                <p class="">開催日時　：　{{$follower_event->start_at}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                    @if(isset($recommend_community_events))
                        @foreach($recommend_community_events as $key => $value)
                            @foreach($recommend_community_events[$key] as $community_event)
                                <div class="d-block col-md-12 py-3 border-top">
                                    <p class="h5 border-bottom border-orange">所属グループ<strong class="text-danger">「{{$key}}」</strong>が開催予定のイベント</p>
                                    <a href="/event/{{$community_event->id}}" class="text-dark">
                                        <div class="row">
                                            <img src="{{$community_event->image_path}}" alt="" class="img_xs">
                                            <div class="col-md-8 mb-0">
                                                <p class="h5">{{$community_event->title}}</p>
                                                <p class="mb-0">開催地　：　{{$community_event->prefecture}}</p>
                                                <p class="">開催日時　：　{{$community_event->start_at}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                    @if(isset($recommend))
                        @foreach($recommend as $event)
                            <p>
                                県内のイベント
                            </p>
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
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{-- カレンダー --}}
            <div class="card" id="calendar"></div>

            {{-- 新着、ランキング --}}
            <div class="border rounded bg-white my-4 font-weight-bold">
                <a class="nav-link text-dark" href="/event/new">・新着イベント</a>
                <a class="nav-link text-dark" href="/community/new">・新着グループ</a>
                <a class="nav-link text-dark" href="/event/popular">・イベントランキング</a>
                <a class="nav-link text-dark" href="/community/popular">・グループランキング</a>
            </div>
        </div>
    </div>
</div>
<script>
    // カレンダーの表示
    window.onload = function() {
        const now   = new Date();
        const year  = now.getFullYear(); //年
        const month = now.getMonth()+1;    //月
        const user_id = "{{"$user->id"}}";  

        // http://homestead.test/calendar/show/2019/11
        // Laravelで実装したカレンダーのビュー(HTML)を渡す機能は　API と呼ぶ

        // fetchで API の URLを実行
        console.log(user_id);
        // console.log("{{"$user->id"}}");
        fetch(`{{ url("/calendar/show") }}/${year}/${month}/${user_id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
        })
        // 返ってきた値(カレンダーのビュー)がthenにくる
        // データはJSON形式でやりとりしている => JSONからJavascriptで読み込める形に変換する必要がある
        .then((res) => res.json())
        // Javascriptで読み込める形に変換された結果が、jsonに入っている
        .then((json) => {
            // jsonの中身 => {html: ..カレンダーのHTML..}

            // JQueryの書き方で、IDがcalendarのHTML要素を取得 => HTMLの要素を埋め込む
            // <div id="calendar">ここの中身にHTMLを埋め込んでいる</div>
            $('#calendar').html(json.html);
        })
        // エラーが発生した場合の処理
        .catch((err) => console.error(err));
    };

    function calendarShow(button) {
        // const button = document.getElementById('prev');
        const year = button.dataset.year;
        const month = button.dataset.month;
        const user_id = "{{"$user->id"}}";  

        fetch(`{{ url("/calendar/show") }}/${year}/${month}/${user_id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
        })
        .then((res) => res.json())
        
        .then((json) => {
            $('#calendar').html(json.html);
        })
        .catch((err) => console.error(err));
    }
</script>

@endsection
