@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    新着グループ（ユーザーと同じ県内で活動してるグループ）
                </div>
                <div class="card-body py-0">
                    @isset($new_communities)
                        @foreach($new_communities as $community)
                            <div class="d-block col-md-12 py-3 border-top">
                                <a href="/community/{{$community->id}}" class="text-dark">
                                    <div class="row">
                                        <img src="{{$community->image_path}}" alt="" class="img_xs col-md-2">
                                        <div class="col-md-8 mb-0">
                                            <p class="h5">{{$community->community_title}}</p>
                                            <p class="mb-0">{{$community->community_subtitle}}</p>
                                            <p class="">{{$community->community_manege}}</p>
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

@endsection
