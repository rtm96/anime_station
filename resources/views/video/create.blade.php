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
    <link rel="stylesheet" href="{{asset('/css/style_createPost.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>投稿する / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')


<div class="content">
    <h3>投稿する</h3>
    <div class="create-form"> 

            <div class="form-floating col-5">
                <input class="form-control" name="detail" rows="3" id="floatingTextarea"></textarea>
                <label for="floatingInput">タイトル</label>
            </div>

            <div class="form-floating col-5">
                <textarea class="form-control" name="detail" rows="3" id="floatingTextarea" style="height: 260px"></textarea>
                <label for="floatingTextarea">詳細</label>
            </div>

            <div class="card col-5">
                <img src="/img/top.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <input class="form-control form-control-sm" id="formFileSm" type="file">
                    <p class="card-text">ファイル名</p>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 445px;">
                <div class="row g-0">
        
                    <div class="col-md-5">
                        <div class="card-body">
                            <h6 class="card-title">サムネイル</h6>
                            <div class="flex-taxt">
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-6">
                        <img src="/img/top.jpg" class="img-fluid rounded-start" alt="thumbnail">
                    </div>
        
                        
                </div>
            </div>

            <div class="under-box">
                <div class="col-3">
                    <label for="type" class="form-label col-4">ジャンル</label>
                    <select class="form-select" name="type">
                        <option value="">選択</option>
                        <option value="1">公開</option>
                        <option value="2">非公開</option>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-custom">投稿する</button>
                </div>
            </div>

</div>

</body>
</html>

