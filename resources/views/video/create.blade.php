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
        {{-- 登録処理 --}}
        <form method="POST" action="{{ route('video.store')}}">
        @csrf

            <div class="form-floating col-5">
                <input class="form-control" name="title" rows="3" id="floatingTextarea" value="{{ old('title') }}">
                <label for="floatingInput">タイトル</label>
                @if ($errors->has('title'))
                    <p class="error-text">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <div class="form-floating col-5">
                <textarea class="form-control" name="detail" rows="3" id="floatingTextarea" style="height: 200px">{{ old('detail') }}</textarea>
                <label for="floatingTextarea">詳細</label>
                @if ($errors->has('detail'))
                    <p class="error-text">{{ $errors->first('detail') }}</p>
                @endif
            </div>

            <div class="form-floating col-5 URL">
                <textarea class="form-control" name="videoURL" rows="3" id="floatingTextarea" style="height: 100px">{{ old('videoURL') }}</textarea>
                <label for="floatingTextarea">動画URL</label>
                @if ($errors->has('videoURL'))
                    <p class="error-text">{{ $errors->first('videoURL') }}</p>
                @endif
            </div>

            <div class="under-box">
                <div class="col-3">
                    <label for="type" class="form-label col-4">ジャンル</label>
                    <select class="form-select" name="type">
                        <option value="">選択</option>
                        <option value="1" @selected(old('type')== 1)>公開</option>
                        <option value="2" @selected(old('type')== 2)>非公開</option>
                    </select>
                    <div class="error-position">
                    @if ($errors->has('type'))
                        <p class="error-text">{{ $errors->first('type') }}</p>
                    @endif
                    </div>
                </div>
            </div>

            <div><button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#createModal">投稿する</button></div>


            {{-- モーダル表示 --}}
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>                           
                        <div class="modal-body">
                        <p>この内容で登録します。よろしいですか？</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary create">登録</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

</div>

</body>
</html>

