@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container font-weight-bold">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item border-left">
                    <a class="nav-link text-orange" href="/event/{{$event->id}}">
                      <i class="fas fa-user-plus"></i> イベント管理者の登録を完了する
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

<form method="POST" action="/addAdministor/event/create/{{$event->id}}">
    @csrf
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                管理者追加フォーム
            </div>
            <div class="card-body pt-0">
                <table class="table mb-0">
                    <tr>
                        <th>
                            <p class="my-2 mb-1">
                                ユーザー名<strong class="text-danger">※必須</strong>
                            </p>
                        </th>
                        <td>
                            <div class="">
                                <input id="user_name" type="" class="form-control @error('user_name') is-invalid @enderror" name="user_name" required>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="text-center border-top pt-3">
                    <button type="submit" class="btn btn-orange w-75 font-weight-bold" name="" value="">
                        管理者に登録する
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            管理者リスト
        </div>
        <div class="card-body pt-0">
            @isset($addministrator_user)
                <table class="table mb-0">
                    @foreach($addministrator_user as $user)
                        <tr>
                            <th>
                                <p class="my-2 mb-1">
                                    <img class="img_follow" src="{{$user->image_path}}" alt="">
                                    <label for="">{{$user->name}}</label>
                                </p>
                            </th>
                            <td>
                                <div class="">
                                    <a class="nav-link btn btn-info font-weight-bold" href="/addAdministor/event/delete/{{$event->id}}/{{$user->id}}">登録解除</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endisset
        </div>
    </div>
</div>

@endsection
