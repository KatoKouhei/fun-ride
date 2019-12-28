@extends('layouts.app')

@section('content')
@if(isset($entry_user) && $entry_user->role_type == 1)
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container font-weight-bold">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item border-left">
                        <a class="nav-link text-white" href="/addAdministrator/event/{{$event->id}}">
                            <i class="fas fa-user-plus"></i> 管理者を追加する
                        </a>
                    </li>
                    <li class="nav-item border-right border-left">
                        <a class="nav-link text-white" href="/event/edit/{{$event->id}}">
                            <i class="far fa-edit mr-1"></i>イベントを編集する
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif

<div class="container py-4">
    <div class="row">
        <div class="w-75">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="row px-1">
                            <div class="btn-orange rounded pt-2 px-1 text-center ">
                                <h4 class="m-0 font-weight-bold">開催日</h4>
                                <h5 class="m-0 font-weight-bold">{{$event->start_at}}</h5>
                            </div>
                            <h3 class="ml-2 pt-3">{{$event->title}}</h3>
                            <h5 class="ml-auto mt-3 p-2 rounded bg-secondary text-white font-weight-bold">定員：{{$entry_num}} / {{$event->capacity}}人</h5>
                        </div>
                    </div>
                    <div class="card-boby ">
                    <img class="d-block mx-auto img_event" src="{{$event->image_path}}" alt="" width="" height="" style="">
                    </div>
                    <div id="subscribe_button" class="card-footer">
                        @if($black_holder == false)
                            @if(isset($entry_user))
                                @if($entry_user->role_type == 1)
                                @else
                                    <button class="btn btn-default border-dark float-right clearfix d-inline-block" onclick="unsubscribe()" name="unsubscribe" id="unsubscribe" value="unsubscribe">イベントを辞退する</button>
                                @endif
                            @else
                                <button class="btn btn-orange border-dark float-right clearfix d-inline-block" onclick="subscribe()" name="subscribe" id="subscribe" value="subscribe">イベントに参加する</button>
                            @endif
                        @else
                            <button class="btn btn-dark border-dark float-right clearfix d-inline-block">イベントに参加できません</button>
                        @endif
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        イベント概要
                    </div>
                    <div class="card-body">
                        {!!$event->description!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="w-25">
            <div class="">
                @if(isset($community))
                    <div class="card">
                        <div class="card-header py-2">
                            <div class="row">
                                <div class="pt-2 pl-1">
                                    グループ
                                </div>
                            </div>
                        </div>
                        <div class="card-boby">
                            <a class="" href="/community/{{$community->id}}" class="text-dark">
                                <div class="card-title text-center mt-1 mb-0">
                                    <p class="h4 text-dark">
                                        {{$community->community_title}}
                                    </p>
                                </div>
                                <img class="d-block img_event col-md-12" src="{{$community->image_path}}" alt="" width="" height="" style="">
                            </a>
                            <div class="text-center">
                                <p class="mb-1">イベント回数：{{$event_num}} 回</p>
                                <p class="mb-1">メンバー数：{{$community_member_num}}人</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header py-2">
                            <div class="row">
                                <div class="pt-2 pl-1">
                                    グループ
                                </div>
                            </div>
                        </div>
                        <div class="card-boby">
                            <div class="card-title text-center mt-1">
                                <h4>所属グループなし</h4>
                            </div>
                        <img class="d-block mx-auto" src="" alt="" width="100" height="100" style="">
                            <div class="text-center">
                                <p class="mb-1">イベント回数： 回</p>
                                <p class="mb-1">メンバー数：人</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card my-4">
                    <div class="card-header px-0 pl-2">
                        ルートマップ
                    </div>
                    <div class="card-body text-left p-2">
                        @isset($event->map_url)
                        <div class="mb-3">
                            <label for="" class="mb-0">・走行マップ（URL）</label>
                            <p>
                                <a class="text-center container" href="{{$event->map_url}}" target="_blank">マップの確認はここをクリック</a>
                            </p>
                        </div>
                        @endisset
                        @isset($event->prefecture)
                            <div class="mb-3">
                                <label for="" class="mb-0">・スタート地点</label>
                                <label for="" class="container mb-0">{{$event->prefecture}}</label>
                            </div>
                        @endisset
                        @isset($event->route)
                            <div class="mb-3">
                                <label for="" class="mb-0">・走行ルート</label>
                                <label for="" class="container mb-0">{{$event->route}}</label>
                            </div>
                        @endisset
                        @isset($event->load_type)
                            <div class="mb-3">
                                <label for="" class="mb-0">・走行内容</label>
                                <label for="" class="container mb-0">{{$event->load_type}}</label>
                            </div>
                        @endisset
                        @isset($event->distance)
                            <div class="mb-3">
                                <label for="" class="mb-0">・総走行距離</label>
                                <label for="" class="container mb-0">{{$event->distance}} Km</label>
                            </div>
                        @endisset
                        @isset($event->level)
                            <div class="mb-3">
                                <label for="" class="mb-0">・走破レベル</label>
                                <label for="" class="container mb-0">{{$event->level}}</label>
                            </div>
                        @endisset
                        @isset($event->location)
                            <div class="mb-3">
                                <label for="" class="mb-0">・集合場所</label>
                                <label for="" class="container mb-0">{{$event->location}}</label>
                            </div>
                        @endisset
                        
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header px-0 pl-2">
                        日時詳細
                    </div>
                    <div class="card-body text-left font-weight-bold h5">
                        <div class="mb-3">
                            <label for="" class="mb-1">・開催日時</label>
                            <label for="" class="container mb-0">{{$event->start_at}}</label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">・終了日時</label>
                            <label for="" class="container mb-0">{{$event->end_at}}</label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">・集合日時</label>
                            <label for="" class="container mb-0">{{$event->meeting_at}}</label>
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header px-0 pl-2">
                        管理者
                    </div>
                    <div class="card-body text-left">
                        @foreach($user_1 as $user)
                            <div class="">
                                <a class="nav-link m-0 p-0 text-dark" href="/user/{{$user->id}}">
                                    ・<img src="{{$user->image_path}}" class="img_follow" alt="">
                                    <label class="px-1 d-line-block h5 my-2">{{$user->name}}</label>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header px-0 pl-2">
                        参加者
                    </div>
                    <div class="card-body text-left">
                        @foreach($user_0 as $user)
                            <div class="">
                                <a class="nav-link m-0 p-0 text-dark" href="/user/{{$user->id}}">
                                    ・<img src="{{$user->image_path}}" width="30" height="30" class="" alt="">
                                    <label class="px-1 d-line-block h5 my-2">{{$user->name}}</label>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // イベントを辞退する
    function unsubscribe() {
        fetch("{{ url("/event/unsubscribe/$event->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
            alert('イベントを辞退しました');
            // TODO:リダイレクトさせる
            // if(is_none_entry){
            //     console.log('aaa');
            //     window.location.href = "{/event/delete/event_id}";
            // }else{
                $('#subscribe_button').html(`
                    <button class="btn btn-orange border-dark float-right clearfix d-inline-block" onclick="subscribe()" name="subscribe" id="subscribe" value="subscribe">イベントに参加する</button>
                `);
            // }
        })
        .catch((err) => console.error(err));
        }
    // イベントに参加する
    function subscribe() {
        // console.log('aaa');
        fetch("{{ url("/event/subscribe/$event->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
        alert('イベントに参加しました');
        // TODO:リダイレクトさせる
        $('#subscribe_button').html(`
            <button class="btn btn-default border-dark float-right clearfix d-inline-block" onclick="unsubscribe()" name="unsubscribe" id="unsubscribe" value="unsubscribe">イベントを辞退する</button>
        `);
        })
        .catch((err) => console.error(err));
    }
</script>

@endsection
