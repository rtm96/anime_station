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
    <link rel="stylesheet" href="{{asset('/css/style_showVideo.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>視聴画面 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

    <div class="content"> 


        {{-- <video width="780" height="420" src="video.mp4" controls autoplay muted allowfullscreen></video> --}}
        <iframe width="560" height="315" src="https://www.youtube.com/embed/GtYV_F71yeE?si=fK7QIV9f3aaHwnT1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        <div class="videoTitle">
            ＢＡＣＫ ＴＯ ＴＨＥ ８０ｓ // calm vaporwave ~ ambient dreamwave mix
        </div>

        <div class="user-data">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle video">
            <strong class="profile-name float-start">ユーザーネーム</strong>
            <strong class="profile-name float-end">いいね</strong>
        </div>

        <div class="btn-position">
        <button type="button" class="btn btn-custom">フォローする</button>
        </div>

        <div class="col-6 detail">
            <div data-bs-spy="scroll" data-bs-target="#list" data-bs-smooth-scroll="true" tabindex="0" data-bs-root-margin="0px 0px -40%" class="scrollspy-example bg-body-tertiary p-2 rounded-2" style="height: 150px">
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


    </div>
</div>

{{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/Yf7-z6P9Q94?si=z-yHh72Xl0dkk8bL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}



</body>
</html>