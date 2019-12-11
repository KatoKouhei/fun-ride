@extends('layouts.app')

@section('content')
@if(isset($member_user) && $member_user->role_type == 1)
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container font-weight-bold">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item border-left">
                        <a class="nav-link text-white" href="/addAdministrator/{{$community->id}}">
                            <i class="fas fa-user-plus"></i> 管理者を追加する
                        </a>
                    </li>
                    {{-- <li class="nav-item border-left">
                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-envelope-square mr-1"></i>グループメッセージを送る
                        </a>
                    </li> --}}
                    <li class="nav-item border-left">
                        <a class="nav-link text-white" href="/blackList/{{$community->id}}">
                            <i class="far fa-times-circle mr-1"></i>ブラックリストを編集する
                        </a>
                    </li>
                    <li class="nav-item border-right border-left">
                        <a class="nav-link text-white" href="/community/edit/{{$community->id}}">
                            <i class="far fa-edit mr-1"></i>グループを編集する
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif

<div class="container py-4">
    <div class="card">
        <div class="row mx-0">
            <div class="w-25 shadow-sm">
                <div class="text-center">
                    <img class="img_community" src="{{$community->image_path}}" alt="" width="" height="">
                </div>
            </div>
            <div class="w-75 mx-0">
                <div class="card-header">
                    <h2 class="d-inline-block my-0">{{$community->community_title}}</h2>
                    <div id="subscribe_button" class=" float-right clearfix">
                        @if(isset($member_user))
                            <button class="btn btn-default border-dark float-right clearfix d-inline-block" onclick="unsubscribe()" name="unsubscribe" id="unsubscribe" value="unsubscribe">グループを退会する</button>
                        @else
                            <button class="btn btn-orange border-dark float-right clearfix d-inline-block" onclick="subscribe()" name="subscribe" id="subscribe" value="subscribe">グループに入会する</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$community->community_subtitle}}</h4>
                    <label for="" class="card-text">{{$community->community_manage}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="w-75 mt-4">
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        開催イベント
                    </div>
                    <div class="card-body pt-0">
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
                            開催予定のあるイベントはありません
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        グループの説明
                    </div>
                    <div class="card-body">
                        <div id="preview">
                            {!! $community->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-25 mt-4 pr-3">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        メンバー( {{$member_num}} 人 )
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="m-0">管理者</h5>
                            <div class="container">
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
                        <div>
                            <h5>メンバー</h5>
                            <div class="container">
                                @foreach($user_0 as $user)
                                    <div class="">
                                        <a class="nav-link m-0 p-0 text-dark" href="/user/{{$user->id}}">
                                            ・<img src="{{$user->image_path}}" class="img_follow" alt="">
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
    </div>
</div>

<script>
    // グループを退会する
    function unsubscribe() {
        fetch("{{ url("/community/unsubscribe/$community->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
            alert('グループを退会しました');
            // TODO:リダイレクトさせる
            // if($is_none_member){
            //     console.log('aaa');
            //     window.location.href = "{/community/delete/community_id}";
            // }else{
                $('#subscribe_button').html(`
                    <button class="btn btn-orange border-dark float-right clearfix d-inline-block" onclick="subscribe()" name="subscribe" id="subscribe" value="subscribe">グループに入会する</button>
                `);
            // }
        })
        .catch((err) => console.error(err));
        }
    // グループに入会する
    function subscribe() {
        fetch("{{ url("/community/subscribe/$community->id") }}", {
            method: 'GET',
        })
        .then((res) => res.json())
        .then((json) => {
        alert('グループに入会しました');
        // TODO:リダイレクトさせる
        $('#subscribe_button').html(`
            <button class="btn btn-default border-dark float-right clearfix d-inline-block" onclick="unsubscribe()" name="unsubscribe" id="unsubscribe" value="unsubscribe">グループを退会する</button>
        `);
        })
        .catch((err) => console.error(err));
    }
</script>
@endsection
