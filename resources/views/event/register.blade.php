@extends('layouts.app')

@section('content')
<head>
    <title>イベント登録｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<nav class="navbar navbar-expand navbar-dark bg-dark shadow-sm">
    <div class="container font-weight-bold">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item border-right border-left">
                    <a class="nav-link text-orange" href="＃">
                        <i class="far fa-edit mr-1"></i>イベント登録中
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form method="POST" action="/event/create" enctype="multipart/form-data">
    @csrf
    <div class="container py-4" id="event-edit">
        <div>
            {{-- イベントの所属グループ --}}
            <div class="card">
                <div class="card-header py-2">
                    <div class="pt-2 pl-1">
                        所属グループ選択
                    </div>
                </div>
                <div class="card-boby p-2">
                    @if(isset($communities) && $is_hold_community_role_1 == true)
                        <select class="form-control" name="community_id" id="community_id" >
                        <option value="0">選択してください</option>
                        @foreach ($communities as $key => $community)
                            <option value="{{$community->id}}">{{$community->community_title}}</option>
                        @endforeach
                        </select>
                    @else
                        <p class="mb-0 p-2">管理しているグループがありません。<a href="/community/register" class="p-2">グループを作成する</a></p>
                    @endif
                </div>
            </div>
            {{-- タイトルとイベント画像 --}}
            
            <div class="card mt-4">
                <div class="card-header">
                    イベントタイトル入力
                </div>
                <div class="card-boby px-2">
                    <table class="table">
                        <tr>
                            <th class="pt-3">イベントタイトル<strong class="text-danger">※</strong></th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" required autocomplete="title" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">サブタイトル</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="subtitle" type="text" class="form-control" name="subtitle" value="" autocomplete="subtitle" autofocus>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- イメージ画像 --}}
            <div class="card mt-4">
                <div class="card-header">
                    イメージ画像
                </div>
                <div class="body p-3">
                    <input class="d-block" type="file" onChange="imagePreview(event)" name="image_path"/>
                    <img class="d-block" id="image_preview" />
                </div>
            </div>

            {{-- イベント概要 --}}
            <div class="row">
                <div class="col-6 mt-4">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                イベントの説明（markdown記入）
                            </div>
                            <div class="card-body">
                                <textarea name="description" id="description" class="col-md-12" cols="60" rows="20">@isset($description){{$description}}@endisset</textarea>
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
                                イベントの説明（プレビュー）
                            </div>
                            <div class="card-body">
                                <div id="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ルートマップ作成／開始時間、終了時間、集合時間・場所 --}}
            <div class="card my-4">
                <div class="card-header px-0 pl-2">
                    ルートマップ
                </div>
                <div class="card-body text-left px-2 py-0">
                    <table class="table">
                        <tr>
                            <th class="">走行マップ（URL）</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="map_url" type="text" class="form-control" name="map_url" autocomplete="" placeholder="URLを添付してください">
                                        <label for="" class="">※以下のサイトで走行ルートを作成し、URLを添付してください。</label>
                                        <a class="text-center" href="https://www.navitime.co.jp/bicycle/" target="_blank">https://www.navitime.co.jp/bicycle/</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                開催住所（スタート地点）<strong class="text-danger">※</strong><strong class="text-danger d-block">都道府県を必ず記入してください</strong>
                            </th>
                            <td>
                                <input id="prefecture" type="text" class="form-control @error('prefecture') is-invalid @enderror" name="prefecture" required autocomplete="" placeholder="スタート地点の住所を記入してください">
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">走行ルート</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="route" type="text" class="form-control" name="route" autocomplete="" placeholder="例：国分駅(strat) → 霧島神宮 → エビの高原(中間折り返し地点) → 霧島温泉卿 → 国分駅(end)">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">走行内容</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        @foreach (config('load_type') as $key => $load_type)
                                            <label class="form-check-label ml-4">
                                                <input type="checkbox" id="load_type" name="load_type[]" value="{{$key}}" class="form-check-input"> {{$load_type}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th class="pt-3">総走行距離(Km)</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="distance" type="text" class="form-control" name="distance" autocomplete="" placeholder="ルート作成サイトで作成したルートの距離を記入してください">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">走行レベル</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        @foreach (config('level') as $key => $level)
                                            <label class="form-check-label ml-4">
                                                <input type="checkbox" id="level" name="level[]" value="{{$key}}" class="form-check-input"> {{$level}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">集合場所</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="location" type="text" class="form-control" name="location" autocomplete="" placeholder="集合場所を記入してください">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            {{-- 開催日時詳細 --}}
            <div class="card">
                <div class="card-header py-2">
                    <div class="pt-2 pl-1">
                        開催日時詳細
                    </div>
                </div>
                <div class="card-boby px-2">
                    <table class="table">
                        <tr>
                            <th class="pt-3">開催日時<strong class="text-danger">※</strong></th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="start_at" name="start_at" type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">終了日時</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="end_at" name="end_at" type="datetime-local" class="form-control" >
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">集合日時</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="meeting_at" name="meeting_at" type="datetime-local" class="form-control" >
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            {{-- 定員 --}}
            <div class="card my-4">
                <div class="card-header px-0 pl-2">
                    定員
                </div>
                <div class="card-body text-left">
                    <table>
                        <tr>
                            <th class="pr-5">定員<strong class="text-danger">※</strong></th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="capacity" type="text" class="form-control" name="capacity" required autocomplete="" placeholder="">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <button type="submit" class="btn btn-orange mt-4 w-100" name="create" value="create">
                イベントを登録する
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
        </div>
    </div>
</form>
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
            preview.setAttribute("class", "img_event");
        };
        const file = onChangeEvent.target.files[0];
        reader.readAsDataURL(file);
    };
</script>
@endsection
