<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://getbootstrap.jp/docs/5.3/assets/css/docs.css" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{asset('/css/style_profile.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>プロフィール / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

<div class="content">
    <div class="position-absolute">
        <img src="{{ Auth::user()->image}}" class="rounded-circle" alt="" width="200" height="200">
    </div>

    <div class="row">
        <p class="userName">{{ Auth::user()->name}}</p>
    </div>

    <a href="#" class="btn btn-custom">編集</a>

    <div class="follow">
        <strong>フォロー数</strong></br>
        <strong>フォロワー数</strong>
    </div>

    <div class="col-7 detail">
        <div data-bs-spy="scroll" data-bs-target="#list" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
          <p>
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容 
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容 
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容 
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容 
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容 
            詳細内容、詳細内容、詳細内容、詳細内容、詳細内容、詳細内容
          </p>
        </div>
    </div>

    <div class="col-2">
        投稿一覧
    </div>

    <div class="col-11">
        <hr>
    </div>

</div>

</div>

</body>
</html>