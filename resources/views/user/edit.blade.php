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
    <link rel="stylesheet" href="{{asset('/css/style_editUser.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>アカウント編集 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')


<div class="content">
    <h3>アカウントを編集する</h3>
    <div class="edit-form"> 
        <a class="btn btn-secondary close" href="{{ route('users.index')}}" role="button">キャンセル</a>


        <div class="position-absolute start-50">
            {{-- <img src="{{ Auth::user()->image ? asset('/storage/img/'.Auth::user()->image) : asset('/img/default-icon.jpg')}}" class="rounded-circle edit" alt="" width="200" height="200"> --}}
            @if($user->image)
            <img id="icon_img_prv" name='image' src="data:image/png;base64,{{$user->image }}" class="rounded-circle edit" alt="" width="200" height="200">
            @else
            <img id="icon_img_prv" name='image' src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle edit" alt="" width="200" height="200">
            @endif
        </div>

        <div class="mb-3 row">
            <label for="inputID" class="col-3 col-form-label">ID</label>
            <div class="col-sm-6">
            <input type="text" name="id" readonly class="form-control-plaintext" id="staticID" value="{{ old('id', $user->id )}}">
            </div>
        </div>

        {{-- 更新処理 --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="inputName" class="col-3 col-form-label">ユーザーネーム</label>
            <div class="col-sm-6">
            <input type="text" name="name" class="form-control" id="inputName" value="{{ old('name', $user->name )}}">
            </div>
            @if ($errors->has('name'))
            <p class="error-text">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="mb-3 row">
            <label for="inputEmail" class="col-3 col-form-label">メールアドレス</label>
            <div class="col-sm-6">
            <input type="email" name="email" class="form-control" id="inputEmail" value="{{ old('email', $user->email )}}">
            </div>
            @if ($errors->has('email'))
            <p class="error-text">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-3 col-form-label">パスワード<br/>（必要であれば）</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="auth" class="col-3 col-form-label">権限</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="auth" name="auth" value="1" {{ $user->auth == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="auth">管理者権限を付与する</label>
            </div>
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
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary update">更新</button>
                    </div>
                </div>
            </div>
        </div>

        </form>

        {{-- 削除処理 --}}
        <form method="POST" action="{{ route('users.destroy', $user->id)}}">
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
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-danger delete">削除</button>
                    </div>
                </div>
            </div>
        </div>
        
        </form>

    </div>
</div>

</body>
</html>