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
    <link rel="stylesheet" href="{{asset('/css/style_accountView.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>アカウント一覧 / anime_station</title>

    <style>
        .container{
            position: sticky;
            top: 0;
        }
        .sidebar-scroll{
            padding: auto;
            margin: auto;
            margin-top: 0; 
            position: sticky;
            top: 0;
        }
        button{
            padding: auto;
            margin: auto;
            margin-top: 0; 
            position: sticky;
            top: 0;
        }
    </style>
</head>
<body class="sidebar-scroll">
<div class="container">
@include('parts.nav')
    <div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
        <div>テスト<br/>テスト<br/>テスト<br/>テスト<br/>テスト</div>
    </div>
    <button>ボタン</button>
</div>

</body>
</html>