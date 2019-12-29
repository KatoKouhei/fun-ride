<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>ファンライド</title> --}}
    <meta name="description" content="誰でも簡単に大規模なファンライドから10名未満の小規模なファンライドまで開催できるファンライドイベント作成webサイトです。仲間を募り、一緒楽しみ、トレーニングして強くなろう。">
    <meta name="keywords" content="ファンライド,funride,fun-ride,FunRide,FUNRIDE,イベント,作成,個人,チーム,募集,">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/appStyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/community.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">
</head>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light header-bg shadow-sm">
            <div class="container font-weight-bold p-0">
                <a class="navbar-brand" href="/home">
                    <h3 class="py-auto my-auto text-orange font-weight-bold">Fun-Ride</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <form class="form-inline ml-auto" method="POST" action="/event/search">
                            @csrf
                            <input type="text" name="keyword" id="keyword" class="form-control mr-2" placeholder="イベント検索">
                            <button class="btn btn-outline-orange font-weight-bold" type="submit">検索</button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">ホーム</a>
                        </li>
                        <li class="nav-item border-right">
                            <a class="nav-link" href="/event/new">新着イベント</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="/event/management">イベント＆グループ管理</a>
                        </li>
                        <li class="nav-item text-orange border-right">
                            <a class="text-orange nav-link" href="/event/register">イベント作成</a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mx-2">
                                <a class="nav-link btn btn-outline-secondary font-weight-bold" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-orange font-weight-bold" href="{{ route('register') }}">新規登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                                        マイページ
                                    </a>
                                    <a class="dropdown-item" href="/"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>

        <!-- footer -->
        <footer id="main-footer" class="bg-secondary text-light p-2">
            <div class="container">
                <div class="row border-bottom">
                    <a class="navbar-brand mr-3" href="/home">
                        <h3 class="text-left text-orange font-weight-bold">
                            Fun-Ride
                        </h3>
                    </a>
                    {{-- <div class="mx-auto ">
                        <ul class="">
                            <p class="lead mb-auto">ご利用ガイド</p>
                            <p class="lead mb-auto">よくある質問</p>
                        </ul>
                    </div> --}}
                    <form class="ml-auto" method="POST" action="/opinion">
                        @csrf
                        <div>
                            <p class="lead text-center mb-auto">Fun-Rideへのご意見をお問い合わせください</p>
                            <p class="text-center mb-auto">
                                <textarea name="opinion" id="opinion" cols="45" rows="3" class=""></textarea>
                            </p>
                            <p class="text-center">
                                <button class="btn btn-default" type="submit">意見を送る</button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="">
                    <p class="lead text-right mb-auto">
                        Copyright &copy; <span id="year"></span> Fun-Ride
                    </p>
                </div>
            </div>
        </footer>
    </div>


    <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
    </script>
</body>
</html>
