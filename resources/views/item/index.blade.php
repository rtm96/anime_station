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

{{-- @foreach ($users as $user) --}}
<div class="content">
    <div class="position-absolute">
        {{-- DBに格納した画像データを再変換して表示 --}}
        @if($user->image)
        <img src="data:image/png;base64,{{$user->image }}" class="rounded-circle" alt="" width="200" height="200">
        @else
        <img src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle" alt="" width="200" height="200">
        @endif
    </div>

    <div class="row">
        <p class="userName">{{ Auth::user()->name}}</p>
    </div>

    <a href="/profile/edit" class="btn btn-custom">編集</a>

    <div class="follow">
        <strong>総いいね数</strong></br>
        <strong>　</strong>
    </div>

    <div class="col-7 detail">
        <div data-bs-spy="scroll" data-bs-target="#list" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
            <p>
                {{ $user->detail }}
            </p>
        </div>
    </div>

    <div class="col-2">
        投稿一覧
    </div>

    <div class="col-11">
        <hr>
    </div>

    @if(session('success'))
    <div class="toast position-fixed bottom-0 end-0 text-bg-primary fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif

</div>
{{-- @endforeach --}}

</div>

</body>
</html>