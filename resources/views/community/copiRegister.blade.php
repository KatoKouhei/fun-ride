@extends('layouts.app')

@section('content')
<head>
    <title>グループ登録｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container font-weight-bold">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item border-right border-left">
                    <a class="nav-link text-orange" href="/community/{{$community->id}}">
                        <i class="far fa-edit mr-1"></i>登録中
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <form method="POST" action="/community/create" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row mb-2 ml-2">
                <div class="w-25">
                    <div class="community-bg-border shadow-sm">
                        <input class="d-block" type="file" onChange="imagePreview(event)" name="image_path"/>
                        <img class="d-block col-md-12 img_community" id="image_preview"  src="{{$community->image_path}}"/>
                    </div>
                </div>
                <div class="w-75 container">
                    <div class="card-header">
                        <div class="form-group">
                            <input id="community_title" type="text" class="form-control mt-0 mb-0 @error('community_title') is-invalid @enderror" name="community_title" value="{{$community->community_title}}" required autocomplete="name" autofocus placeholder="グループ名">
                            @error('community_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        <input id="community_subtitle" type="text" class="form-control mt-0 mb-0" name="community_subtitle" value="{{$community->community_subtitle}}" placeholder="サブタイトル">
                        <input id="community_manage" type="text" class="form-control mt-2 mb-0" name="community_manage" value="{{$community->community_manage}}" placeholder="運営店舗、チーム名">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="w-50 mt-4">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            グループの説明（markdown記入）
                        </div>
                        <div class="card-body">
                                <textarea name="description" id="description" cols="60" rows="20">@if(isset($description)){{$description}}@else{{{$community->description}}}@endif</textarea>
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
            <div class="w-50 mt-4">
                <div class="container">
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
            編集完了
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
    }
</script>
<script>
    function imagePreview(onChangeEvent) {
        const reader = new FileReader();
        reader.onload = onLoadEvent => {
            const preview = document.getElementById('image_preview');
            preview.setAttribute('src', onLoadEvent.target.result);
            preview.setAttribute("class", "col-md-12 img_community");
        };
        const file = onChangeEvent.target.files[0];
        reader.readAsDataURL(file);
    };
</script>
@endsection
