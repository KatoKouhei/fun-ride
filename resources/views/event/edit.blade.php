@extends('layouts.app')

@section('content')

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
                    <a class="nav-link text-orange" href="/event/{{$event->id}}">
                        <i class="far fa-edit mr-1"></i>イベント編集中
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form method="POST" action="/event/update/{{$event->id}}" enctype="multipart/form-data">
    @csrf
    <div class="container py-4">

            {{-- イベントの所属グループ --}}
            <div class="card">
                <div class="card-header py-2">
                    <div class="pt-2 pl-1">
                        所属グループ選択
                    </div>
                </div>
                <div class="card-boby p-2">
                    @if(isset($communities) && $event->community_id !== 0)
                        <select class="form-control" name="community_id" id="community_id" >
                            <option value="0">選択してください</option>
                            @foreach ($communities as $key => $community)
                                @if($community->id == $event->community_id)
                                    <option value="{{$community->id}}" selected>{{$community->community_title}}</option>
                                @else
                                    <option value="{{$community->id}}">{{$community->community_title}}</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <p class="mb-0 p-2">
                            所属しているグループがありません。<a href="/community/register">グループを作成する</a>
                        </p>
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
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$event->title}}" required autocomplete="title" autofocus>
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
                                        <input id="subtitle" type="text" class="form-control" name="subtitle" value="{{$event->subtitle}}" autocomplete="subtitle" autofocus>
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
                    <img class="d-block img_event" id="image_preview" src="{{$event->image_path}}"/>
                </div>
            </div>

            {{-- イベント概要 --}}
            <div class="row">
                <div class="w-50 mt-4">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                イベントの説明（markdown記入）
                            </div>
                            <div class="card-body">
                                <textarea name="description" id="description" class="col-md-12" cols="60" rows="20">
                                    @isset($description){{$description}}@endisset
                                    {{$event->description}}
                                </textarea>
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
                                        <input id="map_url" type="text" class="form-control" name="map_url" autocomplete="" placeholder="URLを添付してください" value="{{$event->map_url}}">
                                        <label for="" class="">※以下のサイトで走行ルートを作成し、URLを項目に添付してください。</label>
                                        <a class="text-center" href="https://www.navitime.co.jp/bicycle/" target="_blank">https://www.navitime.co.jp/bicycle/</a>
                                        @error('map_url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                開催住所（スタート地点）<strong class="text-danger">※</strong><strong class="text-danger d-block">都道府県を必ず記入してください</strong>
                            </th>
                            <td>
                                <input id="prefecture" type="text" class="form-control @error('prefecture') is-invalid @enderror" name="prefecture" required autocomplete="" placeholder="スタート地点の住所を記入してください" value="{{$event->prefecture}}">
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">走行ルート</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="route" type="text" class="form-control" name="route" autocomplete="" placeholder="例：国分駅(strat) → 霧島神宮 → エビの高原(中間折り返し地点) → 霧島温泉卿 → 国分駅(end)" value="{{$event->route}}">
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
                                            @if(in_array($key, $event->load_type))
                                                <label class="form-check-label ml-4">
                                                    <input type="checkbox" id="load_type" name="load_type[]" value="{{$key}}" class="form-check-input" checked> {{$load_type}}
                                                </label>
                                            @else
                                                <label class="form-check-label ml-4">
                                                    <input type="checkbox" id="load_type" name="load_type[]" value="{{$key}}" class="form-check-input"> {{$load_type}}
                                                </label>
                                            @endif
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
                                        <input id="distance" type="text" class="form-control" name="distance" autocomplete="" placeholder="ルート作成サイトで作成したルートの距離を記入してください" value="{{$event->distance}}">
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
                                            @if(isset($event->load_type[$key]))
                                                <label class="form-check-label ml-4">
                                                    <input type="checkbox" id="level" name="level[]" value="{{$key}}" class="form-check-input" checked> {{$level}}
                                                </label>
                                            @else
                                                <label class="form-check-label ml-4">
                                                    <input type="checkbox" id="level" name="level[]" value="{{$key}}" class="form-check-input"> {{$level}}
                                                </label>
                                            @endif
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
                                        <input id="location" type="text" class="form-control" name="location" autocomplete="" placeholder="集合場所を記入してください" value="{{$event->location}}">
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
                                        <input id="start_at" name="start_at" type="datetime-local" class="form-control" value="{{str_replace(" ", "T", $event->start_at)}}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">終了日時</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="end_at" name="end_at" type="datetime-local" class="form-control" value="{{str_replace(" ", "T", $event->end_at)}}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-3">集合日時</th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="meeting_at" name="meeting_at" type="datetime-local" class="form-control" value="{{str_replace(" ", "T", $event->meeting_at)}}">
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
                            <th class="pr-5">定員（人）<strong class="text-danger">※</strong></th>
                            <td>
                                <div class="">
                                    <div class="">
                                        <input id="capacity" type="text" class="form-control" name="capacity" required autocomplete="" placeholder="" value="{{$event->capacity}}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- 管理者登録 --}}
            <div class="card my-4">
                <div class="card-header px-0 pl-2">
                    管理者
                </div>
                <div class="card-body text-left">
                    {{$user->name}}
                </div>
            </div>
            <button type="submit" class="btn btn-orange mt-2 w-100" name="create" value="create">
                イベント編集完了
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
