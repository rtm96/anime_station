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
    <link rel="stylesheet" href="{{asset('/css/style_editPost.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>投稿を編集 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')


<div class="content">
    <h3>投稿を編集する</h3>
    <div class="create-form"> 
            {{-- 商品編集・更新処理 --}}
            <form method="POST" action="{{ route('video.update', $item->id)}}">
            @csrf
            @method('PUT')

            <div class="form-floating col-5">
                <input class="form-control" name="title" rows="3" id="floatingTextarea" value="{{ old('title', $item->title )}}">
                <label for="floatingInput">タイトル</label>
                @if ($errors->has('title'))
                    <p class="error-text">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <div class="form-floating col-5">
                <textarea class="form-control" name="detail" rows="3" id="floatingTextarea" style="height: 200px">{{ old('detail', $item->detail )}}</textarea>
                <label for="floatingTextarea">詳細</label>
                @if ($errors->has('detail'))
                <p class="error-text">{{ $errors->first('detail') }}</p>
                @endif
            </div>

            <div class="form-floating col-5 URL">
                <textarea class="form-control" name="videoURL" rows="3" id="floatingTextarea" style="height: 100px">{{ old('videoURL', $item->videoURL )}}</textarea>
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
                        <option value="1" @selected(old('type', $item->type )== 1)>公開</option>
                        <option value="2" @selected(old('type', $item->type )== 2)>非公開</option>
                    </select>
                    @if ($errors->has('type'))
                        <p class="error-text">{{ $errors->first('type') }}</p>
                    @endif
                </div>
            </div>

            <div><button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#updateModal">更新する</button></div>
            <div><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">投稿を削除</button></div>



                {{-- モーダル表示・更新 --}}
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>                           
                            <div class="modal-body">
                            <p>この内容で登録を更新します。よろしいですか？</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">キャンセル</button>
                            <button type="submit" class="btn btn-primary update">更新</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            {{-- 削除処理 --}}
            <form method="POST" action="{{ route('video.destroy', $item)}}">
            @csrf
            @method('DELETE')

                {{-- モーダル表示・削除 --}}
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>                           
                            <div class="modal-body">
                            <p>本当に削除してよろしいですか？</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">キャンセル</button>
                            <button type="submit" class="btn btn-danger delete">削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

</div>

</body>
</html>

