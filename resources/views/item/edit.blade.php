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
    <link rel="stylesheet" href="{{asset('/css/style_editprofile.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    

    <title>プロフィール編集 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

<div class="content">
    <h3>プロフィールを編集</h3>
    <div class="profile-box"> 
        <a class="btn btn-secondary close" href="{{ route('profile.index')}}" role="button">キャンセル</a>

        {{-- 更新処理 --}}
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="modal-body p-5 pt-0">
                {{-- <img id="icon_img_prv" name='image' src="{{ Auth::user()->image ? asset('/storage/img/'.Auth::user()->image) : asset('/img/default-icon.jpg')}}" class="rounded-circle icon" alt="" width="200" height="200"> --}}
                @if($user->image)
                <img id="icon_img_prv" name='image' src="data:image/png;base64,{{$user->image }}" class="rounded-circle icon" alt="" width="200" height="200">
                @else
                <img id="icon_img_prv" name='image' src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle icon" alt="" width="200" height="200">
                @endif
                <div class="mb-3">
                    <label for="icon" class="label-image">このアイコン画像に決定</label>
                    <div class="col-2 file">
                    <input id="icon" name="image" class="form-control form-control-sm" type="file">
                    </div>
                    @if ($errors->has('file'))
                    <p class="error-text">{{ $errors->first('file') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-floating col-5">
                <input class="form-control" name="name" rows="3" id="floatingInput" value="{{ old('name', $user->name )}}">
                <label for="floatingInput">ユーザーネーム</label>
                @if ($errors->has('name'))
                <p class="error-text">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-floating col-5">
                <textarea class="form-control" name="detail" rows="3" id="floatingTextarea" style="height: 160px">{{ old('detail', $user->detail )}}</textarea>
                <label for="floatingTextarea">詳細</label>
                @if ($errors->has('detail'))
                <p class="error-text">{{ $errors->first('detail') }}</p>
                @endif
            </div>

            <div class="form-floating col-5">
                <input class="form-control" name="email" rows="3" id="floatingInput" value="{{ old('email', $user->email )}}">
                <label for="floatingInput">メールアドレス</label>
                @if ($errors->has('email'))
                <p class="error-text">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-floating col-5">
                <input class="form-control" name="password" rows="3" id="floatingInput">
                <label for="floatingInput">パスワード変更の際に入力</label>
            </div>

            <div class="button-footer">
                <button type="button" class="btn btn-custom edit" data-bs-toggle="modal" data-bs-target="#updateModal">更新する</button>
            </div>

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
                        <button type="button" class="btn btn-secondary modal-cancel" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary update">更新</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

            {{-- 削除処理 --}}
        <form method="POST" action="{{ route('profile.destroy', $user->id)}}">
        @csrf
        @method('DELETE')
            <div class="button-footer">
                <button type="button" class="btn btn-secondary edit" data-bs-toggle="modal" data-bs-target="#deleteModal">アカウントを削除</button>
            </div>
    
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
                        <button type="button" class="btn btn-secondary modal-cancel" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-danger delete">削除</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>

</body>

{{-- JSscript --}}
<script>
    // アイコン画像プレビュー処理
    // 画像が選択される度に、この中の処理が走る
    $('#icon').on('change', function (ev) {
        // このFileReaderが画像を読み込む上で大切
        const reader = new FileReader();
        // ファイル名を取得
        const fileName = ev.target.files[0].name;
        // 画像が読み込まれた時の動作を記述
        reader.onload = function (ev) {
            $('#icon_img_prv').attr('src', ev.target.result).css('width', '200px').css('height', '200px');
        }
        reader.readAsDataURL(this.files[0]);
    })
</script>

</html>