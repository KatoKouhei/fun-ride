@extends('layouts.app')

@section('content')
<head>
    <title>グループ登録｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<nav class="navbar navbar-expand navbar-dark bg-dark shadow-sm">
    <div class="container font-weight-bold">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item border-right border-left">
                    <a class="nav-link text-orange" href="#">
                        <i class="far fa-edit mr-1"></i>グループ登録中
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4" id="community-edit">
    <form method="POST" action="create" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row mb-2 ml-2">
                <div class="col-4">
                    <div class="community-bg-border shadow-sm">
                        {{-- プレビュー画面 --}}
                        <p class="m-0">画像設定</p>
                            <!-- imageのinputタグ -->
                        <input type="file" onChange="imagePreview(event)" name="image_path" />
                            <!-- プレビュー -->
                        <img class="col-md-5 d-block" id="image_preview" />
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-header">
                        <div class="form-group">
                            <input id="community_title" type="text" class="form-control mt-0 mb-0 @error('community_title') is-invalid @enderror" name="community_title" value="" required autocomplete="name" autofocus placeholder="グループ名">
                            @error('community_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- タイトル、サブタイトル、運営・チーム名 --}}
                        <input id="community_subtitle" type="text" class="form-control mt-0 mb-0" name="community_subtitle" value="" placeholder="サブタイトル">
                        <input id="community_manage" type="text" class="form-control mt-2 mb-0" name="community_manage" value="" placeholder="運営店舗、チーム名">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mt-4">
                <div class="">
                    {{-- MarkDown --}}
                    <div class="card">
                        <div class="card-header">
                            グループの説明（markdown記入）
                        </div>
                        <div class="card-body">
                            <textarea name="description" id="description" class="col-12" cols="60" rows="20">@isset($description){{$description}}@endisset</textarea>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-orange" name="change" value="change" onclick="convertMarkdown()">
                                変換する
                            </button>
                            <a class="" href="/markdown" target="_blank">MarkDown記法の書き方</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            グループの説明（プレビュー）
                        </div>
                        <div class="card-body">
                            <div id="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-orange mt-4 w-100" name="create" value="create">
            グループを登録する
        </button>
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>

<script>
    // マークダウンに変換する
    function convertMarkdown() {
        const description = $('#description').val();
        fetch("{{ url('/markdown/convert') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({description})
        }).then((res) => res.json())
        .then((json) => {
            $('#preview').html(json.description);
        })
        .catch((err) => console.error(err));
    };
        // プレビュー画面表示
    function imagePreview(onChangeEvent) {
    // ファイルを読み込むためのオブジェクトを用意
        const reader = new FileReader();

    // ファイルオブジェクト(reader)からファイルを読み込んだ時に実行される関数を用意
        reader.onload = onLoadEvent => {
      // プレビューを表示するimgタグ要素を取得
            const preview = document.getElementById('image_preview');
      // imgタグのsrc属性を書き換える
            preview.setAttribute('src', onLoadEvent.target.result);
            preview.setAttribute("class", "col-md-12 img_community");
        };

    // 変更イベントオブジェクトから、ファイルを取得
        const file = onChangeEvent.target.files[0];
    // readerオブジェクトに読み込ませる(読み込まれた時点でreader.onloadが実行される)
        reader.readAsDataURL(file);
    };
    </script>
@endsection
