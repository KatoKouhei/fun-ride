@extends('layouts.app')

@section('content')
<head>
    <title>イベント・グループ管理｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row">
        
        {{-- イベント列 --}}
        <div class="col-md-6 pl-0 mb-2">
            <div class="p-2 rounded bg-secondary text-white">
                イベント管理
            </div>

            <div class="text-right my-2">
                <button class="btn btn-orange border border-dark" onclick="location.href='/event/register'">
                    イベント作成
                </button>
            </div>

            @if(isset($event_num))
                @foreach($event_num as $event)
                <div class="row rounded bg-warning m-0 mb-2 p-0">
                    <div class="col-7 border-right m-0 p-0">
                        <a class="nav-link text-dark m-0 p-0" href="/event/{{$event->id}}">
                            <div class="d-block mb-0">
                                <img src="{{$event->image_path}}" alt="" class="img_management col-md-5 mt-1 mx-3">
                                <p class="h5 py-auto mt-1 mb-0"><u>{{$event->title}}</u></p>
                                <p class="my-0">{{$event->subtitle}}</p>
                            </div>
                            <div class="d-block">
                                <p class="font-weight-bold my-0">開催日時：{{$event->start_at}}</p>
                                <p class="font-weight-bold my-0">開催住所：{{$event->prefecture}}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn btn-orange my-1 font-weight-bold border border-dark d-block w-100" onclick="location.href='/event/edit/{{$event->id}}'">
                            <i class="fas fa-edit"></i>
                            <label for="" class="management-btn m-0 d-none d-sm-inline">
                                編集
                            </label>
                        </button>
                        <button class="btn btn-light border border-dark mb-1 d-block w-100" onclick="location.href='/event/delete/{{$event->id}}'">
                            <i class="fas fa-trash-alt"></i>
                            <label for="" class="management-btn m-0 d-none d-sm-inline w-100">
                                削除
                            </label>
                        </button>
                        <button class="btn btn-light border border-dark mb-1 d-block w-100" onclick="location.href='/event/copi/register/{{$event->id}}'">
                            <i class="fas fa-copy"></i>
                            <label for="" class="management-btn m-0 d-none d-sm-inline">
                                イベント複製
                            </label>
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                管理イベントがありません
            @endif
        </div>

        {{-- グループ列 --}}
        <div class="col-md-6 pl-0 mb-2">
            <div class="p-2 rounded bg-secondary text-white">
                グループ管理
            </div>

            <div class="text-right my-2">
                <button class="btn btn-info border border-dark" onclick="location.href='/community/register'">
                    グループ作成
                </button>
            </div>

            @if(isset($community_num))
                @foreach($community_num as $key => $community)
                    <div class="row rounded bg-info mx-0 mb-2">
                        <div class="col-7 border-right m-0 p-0">
                            <a class="nav-link text-dark m-0 p-0" href="/community/{{$community->id}}">
                                <div class="d-block mb-0">
                                    <img src="{{$community->image_path}}" alt="" class="img_management col-md-5 mt-1 mx-3">
                                    <p class="h5 py-auto mt-1 mb-0"><u>{{$community->community_title}}</u></p>
                                    <p class="my-0">{{$community->community_subtitle}}</p>
                                </div>
                                <div class="d-block">
                                    <p class="font-weight-bold my-0">イベント回数：{{$community_event_num[$key]}} 回目</p>
                                    <p class="font-weight-bold my-0">メンバー人数：{{$community_member_num[$key]}} 人</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <button class="btn btn-orange my-1 font-weight-bold border border-dark d-block w-100" onclick="location.href='/community/edit/{{$community->id}}'">
                                <i class="fas fa-edit"></i>
                                <label for="" class="management-btn m-0 d-none d-sm-inline">
                                    編集
                                </label>
                            </button>
                            <button class="btn btn-light border border-dark mb-1 d-block w-100" onclick="location.href='/community/delete/{{$community->id}}'">
                                <i class="fas fa-trash-alt"></i>
                                <label for="" class="management-btn m-0 d-none d-sm-inline">
                                    削除
                                </label>　　
                            </button>
                            <button class="btn btn-light border border-dark mb-1 d-block w-100" onclick="location.href='/community/copi/register/{{$community->id}}'">
                                <i class="fas fa-copy"></i>
                                <label for="" class="management-btn m-0 d-none d-sm-inline">
                                    イベント複製
                                </label>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                管理しているグループがありません
            @endif
        </div>
    </div>
</div>

@endsection
