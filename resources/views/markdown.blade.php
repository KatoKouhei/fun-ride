@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            MarkDownとは
        </div>
        <div class="h5">
            <p class="mb-4">
                MarkDown(マークダウン)とは文章をある程度見栄えのする文章へ変換できる機能である。
            </p>
            <p>
                以下に例を記述する
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0"># 見出し</p>
                        <p class="mb-0">## 見出し</p>
                        <p class="mb-0">### 見出し</p>
                        <p class="mb-0">#### 見出し</p>
                        <p class="mb-0">##### 見出し</p>
                        <p class="mb-0">---</p>
                        <p class="mb-0">text</p>
                        <p class="mb-0">リンク</p>
                        <p class="mb-0">「株式会社Fun-Ride」(http:www.funride)運営サイトです</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <p class="h1">見出し</p>
                        <p class="h2">見出し</p>
                        <p class="h3">見出し</p>
                        <p class="h4">見出し</p>
                        <p class="h5 mb-0 pb-0">見出し</p>
                        <hr class="my-0">
                        <p class="mb-0">text</p>
                        <p class="my-0">リンク</p>
                        <p><a href="">株式会社Fun-Ride</a>運営サイトです。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            段落・改行のやり方
        </div>
        <div class="h5">
            <p class="mb-0">
                段落は空行を1つ入れる
            </p>
            <p>
                改行は文末にスペースを2つ以上いれる。
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0">段落</p>
                        <p class="mb-0">ああああああ</p>
                        <br>
                        <p class="mb-0">ああああああ</p>
                        <br>
                        <p class="mb-0">改行</p>
                        <p class="mb-0">ああああああ　　</p>
                        <p class="mb-0">ああああああ</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <p class="mb-0">段落</p>
                        <p class="mb-0">ああああああ</p>
                        <br>
                        <p class="mb-0">ああああああ</p>
                        <br>
                        <p class="mb-0">改行</p>
                        <p class="mb-0">ああああああ</p>
                        <p class="mb-0">ああああああ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            フォントの大きさについて
        </div>
        <div class="h5">
            <p class="mb-0">
                段落は空行を1つ入れる
            </p>
            <p>
                改行は文末にスペースを2つ以上いれる。
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0"># 見出し</p>
                        <p class="mb-0">## 見出し</p>
                        <p class="mb-0">### 見出し</p>
                        <p class="mb-0">#### 見出し</p>
                        <p class="mb-0">##### 見出し</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <p class="h1">見出し</p>
                        <p class="h2">見出し</p>
                        <p class="h3">見出し</p>
                        <p class="h4">見出し</p>
                        <p class="h5 mb-0 pb-0">見出し</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            フォントの大きさ
        </div>
        <div class="h5">
            <p class="mb-0">
                段落は空行を1つ入れる
            </p>
            <p>
                改行は文末にスペースを2つ以上いれる。
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0"># 見出し</p>
                        <p class="mb-0">## 見出し</p>
                        <p class="mb-0">### 見出し</p>
                        <p class="mb-0">#### 見出し</p>
                        <p class="mb-0">##### 見出し</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <p class="h1">見出し</p>
                        <p class="h2">見出し</p>
                        <p class="h3">見出し</p>
                        <p class="h4">見出し</p>
                        <p class="h5 mb-0 pb-0">見出し</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            水平線
        </div>
        <div class="h5">
            <p class="mb-0">
                「-」、「_」、「*」を3つ以上並べることで水平線を表示します。
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0">ｰｰｰ</p>
                        <p class="mb-0">***</p>
                        <p class="mb-0">___</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <hr class="my-2">
                        <hr class="my-2">
                        <hr class="my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="h2 border-bottom border-orange">
            リンク
        </div>
        <div class="h5">
            <p class="mb-0">
                [リンク文字列](URL)でリンクに変換されます。
            </p>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center h5">text</p>
                    <div class="border">
                        <p class="mb-0">MarkDownについての参照ページを以下に記します　　</p>
                        <p class="mb-0">「株式会社アーティス」(https://www.asobou.co.jp/blog/bussiness/markdown)</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center h5">変換後</p>
                    <div class="border">
                        <p class="mb-0">MarkDownについての参照ページを以下に記します</p>
                        <p class="mb-0"><a href="https://www.asobou.co.jp/blog/bussiness/markdown" target="_blank">「株式会社アーティス」</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
