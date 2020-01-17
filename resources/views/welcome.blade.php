@extends('layouts.app')

@section('content')
<head>
    <title>さあ、ファンライドを開催しよう！ファンライドイベント作成サイト【ファンライド】</title>
</head>
<section id="showcase">
    <div class="welcome_img text-white text-center">
        <h1 class="mt-4 display-4 text-shadow text-orange">ライダーを繋ぐプラットフォーム</h1>
        <p class="h2 text-shadow mb-4 text-orange">～　簡易Fun-Ride開催サイト　～</p>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-dark">
                        <div class="card-header h5 border-bottom font-weight-bold">
                            自分たちのコミュニティーを作ろう
                        </div>
                        <div class="card-body" height="1000">
                            <img class="welcome_png" src="../image/welcome1.png" alt="">
                            <p class="text-left">
                                グループを作製し、<strong>同じ思いを持つ仲間とのコニュニティー</strong>を作れる。
                                グループに所属するとグループが開催するイベントが通知される
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-dark">
                        <div class="card-header h5 border-bottom font-weight-bold">
                            イベントを開催して参加者を募ろう
                        </div>
                        <div class="card-body">
                            <img class="welcome_png" src="../image/welcome2.png" alt="">
                            <p class="text-left">
                                イベントを作製するとサイト内で公開され、参加者を募集できる。
                                <strong>グループでイベントを開催するとグループの歴史として残せる。</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-dark">
                        <div class="card-header h5 border-bottom font-weight-bold">
                            フォローした人の情報をゲット
                        </div>
                        <div class="card-body">
                            <img class="welcome_png" src="../image/welcome3.png" alt="">
                            <p class="text-left">
                                フォローするとフォローした人が参加するイベントが通知される。
                                <strong>気になるイベントを見逃さない。</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6">
                    <img class="welcome-img" src="../image/welcome4.png" alt="">
                </div>
                <div class="col-md-6 mr-auto my-auto">
                    <div class="d-none d-sm-block mb-5 mx-4">
                        <h1 class="h2 my-4">誰でも簡単にFun-Rideを開催できる !</h1>
                        <p class="lead welcome-p">
                            Fun-Rideでイベント作成して、仲間を募ろう！
                            作成後はイベントが掲示板に掲載されるため、サイクルイベントのポスター宣伝等は不要。
                            無料で簡単にイベントを開催できる。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 my-auto mr-auto">
                    <div class="d-none d-sm-block mb-5 mx-4">
                        <h1 class="h2 my-4">仲間と一緒に楽しく走ろう！</h1>
                        <p class="lead welcome-p">
                            周りにロードバイクをする人がいない人、
                            初心者で一人で走るのが怖い人も経験者と一緒に走れば安心！
                            楽しみを共有し、Fun-Rideを楽しもう！
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mr-auto">
                        <img class="welcome-img" src="../image/welcome5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container pb-4">
            <div class="row py-4">
                <div class="col-md-6 ">
                    <div class="ml-auto">
                        <img class="welcome-img" src="../image/welcome6.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 mr-auto my-auto">
                    <div class="d-none d-sm-block mb-5 mx-4">
                        <h1 class="h2 my-4">仲間と一緒に練習して強くなろう！</h1>
                        <p class="lead welcome-p">
                            自分一人だけでトレーニングが続かない、挫折してしまう人は仲間の力を借りて練習しよう！
                            トレーニング用のグループを作成し、お互いを高め合おう！。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="myCarousel" class="carousel slide bg-white" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class=" text-left">
                <div class="carousel-item carousel-image-1 active mx-auto">
                    <div class="">
                        <div class="d-none d-sm-block mb-5">
                            <h1 class="display-4 mt-4">誰でも簡単にFun-Rideを開催できる</h1>
                            <p class="lead">
                                Fun-Rideでイベント作成して、仲間を募ろう！
                                作成後はイベントが掲示板に掲載されるため、サイクルイベントのポスター宣伝等は不要。無料で簡単にイベントを開催できる。
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-item carousel-image-2 mx-auto">
                    <div class="">
                        <div class="d-none d-sm-block mb-5">
                            <h1 class="display-4 mt-4">仲間と一緒に楽しく走ろう！</h1>
                            <p class="lead">
                                周りにロードバイクをする人がいない人、初心者で一人で走るのが怖い人もみんなと一緒に走れば安心！
                                楽しみを共有し、Fun-Rideを楽しもう！
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-item carousel-image-3 mx-auto">
                    <div class="">
                        <div class="d-none d-sm-block mb-5">
                            <h1 class="display-4 mt-4">仲間と一緒に練習して強くなろう！</h1>
                            <p class="lead">
                                自分一人だけでトレーニングが続かない、挫折してしまう人は仲間の力を借りて練習しよう！
                                トレーニング用のグループを作成し、お互いを高め合おう！
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
            <span class="carousel-control-prev-icon "></span>
        </a>
        
        <a href="#myCarousel" data-slide="next" class="carousel-control-next">
            <span class="carousel-control-next-icon"></span>
        </a>
        
    </div> --}}
</section>

<div class="">
    <div class="rounded border border-dark bg-dark">
        <p class="h1 text-center text-white my-4">さあ、Fun-Rideを開催しよう !</p>
        <div class="text-center mb-4 ">
            <button class="btn btn-orange border border-dark mr-4" onclick="location.href='/event/register'">
                <p class="h3 mb-0 font-weight-bold">
                    イベント作成
                </p>
            </button>
            <button class="btn btn-info border border-dark" onclick="location.href='/community/register'">
                <p class="h3 mb-0 font-weight-bold">
                    グループ作成
                </p>
            </button>
        </div>
    </div>

</div>
@endsection
