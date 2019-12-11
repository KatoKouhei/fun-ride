@extends('layouts.app')



@section('content')
<div class="text-center bg-light">
  <h1 class="display=1">Fan-Ride</h1>
  <p> ～個人ツーリング開催サイト～</p>
</div>
<div class="bg-info py-5">
  <div class="container w-75">
    <u><p class="lead">・ 投稿</p></u>

    <form method="post" action="/post/store" class="border-dark card">
      <div class="mx-auto container mt-3">
        <div class="form-group">
          <label><u>ツーリングタイトル</u></label>
          <input type="text" name="title" id="title" class="form-control" placeholder="例：乗鞍岳レース">
          {{-- <input type="hidden" name="title" id="title" class="form-control" placeholder="タイトル"> --}}
        </div>
        <label class="mt-3"><u>走行内容</u></label>

        <div class="row mx-auto px-auto">
          <div class="form-group">
            <label for="prefecture">開催都道府県</label>
            <select class="form-control" name="prefecture" id="prefecture">
              <option value="0">選択してください</option>
              @foreach (config('prefectures') as $key => $prefecture)
                <option value="{{$key}}">{{$prefecture}}</option>
              @endforeach
            </select>
          </div>

        </div>
        <div class="form-group my-3">
          <label style="width:10%">走行内容</label>
          <label class="">：</label>
          @foreach (config('load_type') as $key => $load_type)
            <label class="form-check-label ml-4">
              <input type="checkbox" id="load_type" name="load_type[]" value="{{$key}}" class="form-check-input"> {{$load_type}}
            </label>
          @endforeach
        </div>

        <div class="form-group">
          <label for="map_url">走行マップ作成</label>
          <label >　　　　※ 右のURLより走行マップを作成し、以下の空欄に添付してください。</label>
          <a href="https://www.navitime.co.jp/bicycle/" target="_blank">https://www.navitime.co.jp/bicycle/</a>
          <input type="text" name="map_url" id="map_url" class="form-control" placeholder="例：https://www.navitime.co.jp/maps/routeResult?goal=%7b%22spot%22%3a%2202025-692587%22%2c%22name%22%3a%22%e4%b9%97%e9%9e%8d%e3%83%90%e3%82%b9%e3%82%bf%e3%83%bc%e3%83%9f%e3%83%8a%e3%83%ab%22%2c%22lon%22%3a495197647%2c%22road-type%22%3a%22default%22%2c%22lat%22%3a130050727%7d&start-time=2019-09-23T14%3a37%3a51&bicycle=only.multi.turn&start=%7b%22node%22%3a%2200294131%22%2c%22name%22%3a%22%e4%ba%94%e8%89%b2%e3%83%b6%e5%8e%9f%e5%85%a5%e5%b1%b1%e5%8f%a3%22%2c%22lon%22%3a495016379%2c%22road-type%22%3a%22default%22%2c%22lat%22%3a130226691%7d">
        </div>

        <div class="form-group">
          <label>走行距離（Km）</label>
          <input type="text" name="distance" id="distance" class="form-control" placeholder="例：88（作製したマップの走行距離を添付してください。）">
        </div>

        <div class="form-group">
          <label>走行経路</label>
          <input type="text" name="route" id="route" class="form-control" placeholder="始点→中間地点1→中間地点2（折り返し地点）→中間地点3→終点">
        </div>

        <div class="form-group">
          <label>集合場所</label>
          <input type="text" name="location" id="location" class="form-control" placeholder="例：五色ヶ原入山口（宿泊施設前）">
        </div>

        <div class="form-group w-25">
          <div>
            <label>集合日時</label>
          </div>
          <div>
            <input id="meeting_at" name="meeting_at" type="datetime-local" class="form-control">
          </div>
        </div>

        <label class="mt-5"><u>募集内容</u></label>

        <div class="row mx-auto px-auto">
          <div class="form-group">
            <div>
              <label>開催日時</label>
            </div>
            <div>
              <input id="start_at" name="start_at" type="datetime-local" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div>
              <label>終了日時</label>
            </div>
            <div>
              <input id="end_at" name="end_at" type="datetime-local" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <label>定員</label>
            <input type="text" name="capacity" id="capacity" class="form-control" placeholder="定員">
          </div>
        </div>

        <div class="form-group">
          <label style="width:10%">走行レベル</label>
          <label class="">：</label>
          @foreach (config('level') as $key => $level)
            <label class="form-check-label ml-4">
              <input type="checkbox" id="level" name="level[]" class="form-check-input" value="{{$key}}"> {{$level}}
            </label>
          @endforeach
        </div>

        <div class="form-group mt-2">
          <label style="width:10%">車種</label>
          <label class="">：</label>
          @foreach (config('model') as $key => $model)
            <label class="form-check-label ml-4">
              <input type="checkbox" id="model" name="model[]" class="form-check-input" value="{{$key}}"> {{$model}}
            </label>
          @endforeach
        </div>
        
        <div class="form-group">
          <label style="width:10%">募集年齢</label>
          <label class="">：</label>
          @foreach (config('age') as $key => $age)
            <label class="form-check-label ml-4">
              <input type="checkbox" name="age[]" class="form-check-input" value="{{$key}}"> {{$age}}
            </label>
          @endforeach
        </div>

        <div class="form-group">
          <label>詳細</label>
          <textarea class="form-control" rows="10" name="detail" id="detail" placeholder=
"例：50Km先のカフェで昼飯を食べます。
  山の上の気温は約10℃です。ウィンドブレーカーをご持参ください。
          "></textarea>
        </div>
        @csrf
        <input type="submit" value="記事を投稿する" class="mx-auto btn btn-primary btn-block btn-lg mb-3 text-center w-75">
      </div>

    </form>
  </div>
</div>
@endsection
