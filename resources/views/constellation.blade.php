<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>星座占い</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  </head>
  <body>
    <div class="container title text-center">
      <h1>星座占い</h1>
    </div>

    @csrf
  {{-- 一行目 --}}
    <div class="card-columns card-group">
      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza01.gif" alt="" class="img-fluid card-img-top">
        <a class="btn btn-danger btn-lg" href="/constellation/ohitsuzi">おひつじ座</a>
        <p>3/21 ~ 4/19</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza02.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="ousi" id="ousi" value="おうし座">
        <p>4/20 ~ 5/20</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza03.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="hutago" id="hutago" value="ふたご座">
        <p>5/21 ~ 6/21</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza04.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="kani" id="kani" value="かに座">
        <p>6/22 ~ 7/22</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza05.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="sisi" id="sisi" value="しし座">
        <p>7/23 ~ 8/22</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza06.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="otome" id="otome" value="おとめ座">
        <p>8/23 ~ 9/22</p>
      </div>
    </div>

    {{-- @csrf --}}
    {{-- 二行目 --}}
    <div class="card-columns card-group">
      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza07.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="tenbin" id="tenbin" value="てんびん座">
        <p>9/23 ~ 10/23</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza08.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="sasori" id="sasori" value="さそり座">
        <p>10/24 ~ 11/21</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza09.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="ite" id="ite" value="いて座">
        <p>11/22 ~ 12/21</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza10.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="yagi" id="yagi" value="やぎ座">
        <p>12/22 ~ 1/19</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza11.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="mizugame" id="mizugame" value="みずがめ座">
        <p>1/20 ~ 2/18</p>
      </div>

      <div class="card text-center mr-4 border-0">
        <img src="https://s.yimg.jp/images/fortune/images/12astro/blog/yftn_12astro_html_seiza12.gif" alt="" class="img-fluid card-img-top">
        <input class="btn btn-danger btn-lg" type="submit" name="uo" id="uo" value="うお座">
        <p>2/19 ~ 3/20</p>
      </div>

    </div>

    @isset($seiza)
    <div id="jumpdtl">
        <table summary="12星座占い">
        <tr>
        <td><img src="https://s.yimg.jp/images/fortune/images/12astro/yftn_md20_12astro01.gif" alt="おひつじ座"></td>
        <td><table>
        <tr>
        <th><a href="/12astro/ranking.html">12星座運勢ランキング</a></th>
        <td><img src="https://s.yimg.jp/images/fortune/images/common/yftn_icon_06.gif" alt="1位"><strong>{{$seiza}}</strong></td>
        </tr>
        <tr>
        <th><a href="#lnk01">総合運</a></th>
        <td><img src="https://s.yimg.jp/images/fortune/images/common/yftn_param_tot100.gif" alt="100点中98点"></td>
        </tr>
        <tr>
        <th><a href="#lnk02">恋愛運</a></th>
        <td><img src="https://s.yimg.jp/images/fortune/images/common/yftn_param_lov100.gif" alt="10点中10点"></td>
        </tr>
        <tr>
        <th><a href="#lnk03">金運</a></th>
        <td><img src="https://s.yimg.jp/images/fortune/images/common/yftn_param_mny100.gif" alt="10点中10点"></td>
        </tr>
        <tr>
        <th><a href="#lnk04">仕事運</a></th>
        <td><img src="https://s.yimg.jp/images/fortune/images/common/yftn_param_wrk090.gif" alt="10点中9点"></td>
        </tr>
        </table></td>
        </tr>
        </table>
        </div>
        </div>
        </div>    
        @endisset

    {{-- @isset($seiza)
      <p>{{$seiza}}のあなたは幸運です</p>
    @endisset --}}

  </body>
</html>
