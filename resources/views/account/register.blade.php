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

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- CSS --}}
    <link rel="stylesheet" href="{{asset('/css/style_register.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    

    <title>アカウント登録 / anime_station</title>
</head>
    <body>
        <div class="home">
            <div class="container">
                <div class="header text-center mt-5 mb-5">
                    <p class="fs-3">アカウントを登録する</p>
                </div>

                <form action="{{ route('acctRegister') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row justify-content-center"> <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    　
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="name" class="form-control rounded-3" id="floatingInput1" name="name" placeholder="ユーザーネーム" value="{{ old('name') }}" autofocus>
                                    <label for="floatingInput" class="label-color">ユーザーネーム</label>
                                    @if ($errors->has('name'))
                                    <p class="error-text">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control rounded-3" id="floatingInput2" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                                    <label for="floatingInput" class="label-color">メールアドレス</label>
                                    @if ($errors->has('email'))
                                    <p class="error-text">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control rounded-3" id="floatingInput3" name="password" placeholder="パスワード">
                                    <label for="floatingPassword" class="label-color">パスワード</label>
                                    @if ($errors->has('password'))
                                    <p class="error-text">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control rounded-3" id="floatingInput4" name="password_confirmation" placeholder="パスワード">
                                    <label for="floatingPassword" class="label-color">パスワード確認</label>
                                    @if ($errors->has('password'))
                                    <p class="error-text">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="modal-body p-5 pt-0">
                                    <img id="icon_img_prv" src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle" alt="" width="200" height="200">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">このアイコン画像に決定</label>
                                        <input id="icon" class="form-control" type="file">
                                    </div>
                                </div>

                                <div>
                                    <button class="w-50 btn btn-custom" type="submit">アカウント登録</button>
                                    <br/>
                                    <small class="text-body-secondary">By clicking Entry, you agree to the terms of use.</small>
                                </div>
                            </div>
                        </div>
                    </div></div>
                </div>
                </form>

                <div class="text-end mt-3">
                    <a href="{{ url('/') }}">ログイン画面へ</a>
                </div>
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
