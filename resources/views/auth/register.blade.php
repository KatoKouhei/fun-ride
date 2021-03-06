@extends('layouts.app')

@section('content')
<head>
    <title>USER登録｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4" id="user-edit">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-left mb-3">
                <h3 class="border-bottom border-orange">新規登録画面</h3>
            </div>
            <div class="card">
                <div class="card-header">個人設定</div>
                <div class="card-body">
                    <form method="POST" action="register" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th class="pt-3">ユーザー名<strong class="text-danger">※</strong></th>
                                <td>
                                    <div class="">
                                        <div class="">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">メールアドレス<strong class="text-danger">※</strong></th>
                                <td>
                                    <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="name" autofocus>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p class="my-2 mb-1">
                                        パスワード<strong class="text-danger">※</strong>
                                    </p>
                                    <p class="mb-0 mt-4 pt-1">
                                        確認パスワード<strong class="text-danger">※</strong>
                                    </p>
                                </th>
                                <td>
                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="mt-2">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">住所：都道府県<strong class="text-danger">※</strong></th>
                                <td>
                                    <select class="form-control" name="prefecture" id="prefecture">
                                        <option value="0">選択してください</option>
                                    @foreach (config('prefectures') as $key => $prefecture)
                                        <option value="{{$key}}">{{$prefecture}}</option>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">脚質<strong class="text-danger">※</strong></th>
                                <td>
                                    @foreach (config('ride_type') as $key => $ride_type)
                                        <label class="form-check-label ml-4">
                                            <input type="checkbox" id="ride_type" name="ride_type[]" value="{{$key}}" class="form-check-input"> {{$ride_type}}
                                        </label>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">自己紹介</th>
                                <td>
                                    <textarea class="form-control" name="profile" id="profile" cols="60" rows="10" placeholder="ー記入例ー
ライド歴：4年
マウンテンサイクリングin乗鞍：8位
Fun-Ride店　店員"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">プロフィール画像</th>
                                <td>
                                    <img id="image_preview" class="img-profile col-md-6"/>
                                    <input type="file" onChange="imagePreview(event)" name="image_path"/>
                                </td>
                            </tr>
                            <tr>
                                <th class="pt-3">メール通知設定</th>
                                <td>
                                    <p class="mb-0 font-weight-bold">フォロー</p>
                                    @foreach (config('follow_mail') as $key => $follow_mail)
                                        <div class="form-group ml-4 mb-0">
                                            <label for="" class="form-check-label">
                                                <input type="checkbox" id="mail_preference" name="mail_preference[]" value="{{$key}}" type="checkbox" class="form-check-input">{{$follow_mail}}
                                            </label>
                                        </div>
                                    @endforeach
                                    {{-- <div class="border border-bottom my-1"></div>

                                    <p class="mb-0 font-weight-bold">開催イベント</p>
                                    @foreach (config('open_mail') as $key => $open_mail)
                                        <div class="form-group ml-4 mb-0">
                                            <label for="" class="form-check-label">
                                                <input type="checkbox" id="mail_preference" name="mail_preference[]" value="{{$key}}" type="checkbox" class="form-check-input">{{$open_mail}}
                                            </label>
                                        </div>
                                    @endforeach --}}
                                    <div class="border border-bottom my-1"></div>

                                    <p class="mb-0 font-weight-bold">参加イベント</p>
                                    @foreach (config('entry_mail') as $key => $entry_mail)
                                        <div class="form-group ml-4 mb-0">
                                            <label for="" class="form-check-label">
                                                <input type="checkbox" id="mail_preference" name="mail_preference[]" value="{{$key}}" type="checkbox" class="form-check-input">{{$entry_mail}}
                                            </label>
                                        </div>
                                    @endforeach
                                    {{-- <div class="border border-bottom my-1"></div>

                                    <p class="mb-0 font-weight-bold">Fun-Rideからのお知らせ</p>
                                    <div class="form-group ml-4 mb-0">
                                        <label for="" class="form-check-label">
                                            <input type="checkbox" id="mail_preference" name="mail_preference[]" value="10" type="checkbox" class="form-check-input">Fun-Rideからの重要なお知らせやサービスの更新情報
                                        </label>
                                    </div> --}}
                                    <div class="border border-bottom my-1"></div>

                                    <p class="mb-0 font-weight-bold">グループからの通知設定</p>
                                    <div class="form-group ml-4 mb-1">
                                        <label for="" class="form-check-label">
                                            <input type="checkbox" id="mail_preference" name="mail_preference[]" value="11" type="checkbox" class="form-check-input">グループのイベントが公開された時
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-orange">
                                    登録する
                                </button>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function imagePreview(onChangeEvent) {
        const reader = new FileReader();
        reader.onload = onLoadEvent => {
            const preview = document.getElementById('image_preview');
            preview.setAttribute('src', onLoadEvent.target.result);
            preview.setAttribute("class", "img-profile col-md-6");
        };
        const file = onChangeEvent.target.files[0];
        reader.readAsDataURL(file);
    };
</script>
@endsection
