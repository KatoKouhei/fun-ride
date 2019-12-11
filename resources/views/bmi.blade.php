<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  </head>
  <body>
  <h1>BMI 計算ページです</h1>
  <form method="post">
  @csrf
    <div>
      <label for="weight">体重</label>
      <input type="text" name="weight" id="weight"> 
    </div>
    <div>
      <label for="height">身長</label>
      <input type="text" name="height" id="height">
    </div>
    <input type="submit" value="計算する">
  </form>
  @isset($bmi)
  <p>あなたのBMIは{{$bmi}}です</p>
  @endisset



  </body>
</html>
