@extends('layouts.app')

@section('content')
<head>
    <title>イベント検索｜さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<div class="container py-4">
    <div class="row">
        <div class="col-md-9">
            <form action="/event/research" method="post">
                @csrf
                <div class="card">
                    <div class="card-boby">
                        <table class="table p-1 pb-0 mb-0">
                            <tr>
                                <th class="">
                                    キーワード
                                </th>
                                <td>
                                    <input type="text" class="form-control" name="keyword" id="keyword">
                                </td>
                            </tr>
                            <tr>
                                <th class="">
                                    開催日
                                </th>
                                <td>
                                    <div class="form-group m-0">
                                        <input type="text" class="border rounded" name="start_at_1" id="start_at_1" placeholder="{{$today}}">
                                        <label for=""> ~ </label>
                                        <input type="text" class="border rounded" name="start_at_2" id="start_at_2" placeholder="{{$add_15day}}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="">
                                    走行距離（Km）
                                </th>
                                <td>
                                    <div class="form-group m-0">
                                        <input type="text" class="border rounded" name="distance1" id="distance1" placeholder="">
                                        <label for=""> ~ </label>
                                        <input type="text" class="border rounded" name="distance2" id="distance2">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="m-0">
                                    走行内容
                                </th>
                                <td>
                                    @foreach (config('load_type') as $key => $load_type)
                                        <label class="form-check-label ml-4">
                                            <input type="checkbox" id="load_type" name="load_type[]" value="{{$key}}" class="form-check-input"> {{$load_type}}
                                        </label>
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="m-0">
                                    走行レベル
                                </th>
                                <td>
                                    @foreach (config('level') as $key => $level)
                                        <label class="form-check-label ml-4">
                                            <input type="checkbox" id="level" name="level[]" value="{{$key}}" class="form-check-input"> {{$level}}
                                        </label>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-orange m-2 w-75">検索する</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card mt-4">
                <div class="card-header">
                    検索結果
                </div>
                <div class="card-body py-0">
                    @isset($result)
                        @foreach($result as $event)
                            <div class="d-block col-md-12 py-3 border-top">
                                <a href="/event/{{$event->id}}" class="text-dark">
                                    <div class="row">
                                        <img src="{{$event->image_path}}" alt="" class="img-xs col-md-2">
                                        <div class="col-md-8 mb-0">
                                            <p class="h5">{{$event->title}}</p>
                                            <p class="mb-0">開催地　：　{{$event->prefecture}}</p>
                                            <p class="">開催日時　：　{{$event->start_at}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded bg-white font-weight-bold">
                <a class="nav-link text-dark" href="/event/new">・新着イベント</a>
                <a class="nav-link text-dark" href="/community/new">・新着グループ</a>
                <a class="nav-link text-dark" href="/event/popular">・イベントランキング</a>
                <a class="nav-link text-dark" href="/community/popular">・グループランキング</a>
            </div>
        </div>
    </div>
</div>
<script>
    // $('start_at').text(new Date().getFullYear());
</script>
@endsection
