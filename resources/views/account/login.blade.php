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
    <link rel="stylesheet" href="{{asset('/css/style_account.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JSscript --}}
    <script>
        window.onload = function(){
        // テキストボックスのDOMを取得
        const username = document.getElementById("floatingInput1","floatingInput2","floatingInput3","floatingInput4");
        // 活性/非活性を切り替えるボタンのDOMを取得
        const button = document.getElementById("sendbutton");
        // 入力テキストのキーアップイベント
        username.addEventListener('keyup', function() {
        // テキストボックスに入力された値を取得
        const text = username.value;
        console.log(text);
        // テキストが入力されている場合
        if(text) {
        // ボタンのdisabled属性を取り除く
            button.disabled = null;
            } else {
        // ボタンにdisabledを設定する
            button.disabled = "disabled";
            }
        })
        }
    </script>

    <title>ログイン / anime_station</title>
</head>
    <body>
        {{-- トップ画面 --}}
        <h1>あなたの中に<br/>眠る創造を、<br/>解き放つ場所</h1>
        <h2>anime<br/>station</h2>
        <div class="d-grid gap-2 col-3 mx-auto">
            <label>いますぐエントリー</label>
            <a class="btn btn-custom" href="{{ route('register')}}" role="button">アカウント作成</a>
                <p class="p-select">or</p>
            <label>アカウントをお持ちの方はこちら</label>
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal">ログイン</button>
        </div>

        {{-- ログインモーダル表示 --}}
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
            <div>
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h4 class="fw-bold mb-0 fs-2">anime_station<br/>にログイン</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('login') }}">
                    @csrf
                        <div class="modal-body p-5 pt-0">
                            <div class="form-floating mb-4">
                                <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="メールアドレス" value="{{ old('email') }}">
                                <label for="floatingInput" class="label-color">メールアドレス</label>
                                @if ($errors->has('email'))
                                    <p class="error-text">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="パスワード">
                                <label for="floatingPassword" class="label-color">パスワード</label>
                                @if ($errors->has('password'))
                                <p class="error-text">{{ $errors->first('password') }}</p>
                                @elseif ($errors->has('loginError'))
                                    <p class="error-text">{{ $errors->first('loginError') }}</p>
                                @endif
                            </div>
                            <div>
                                <p class="p-modal">いますぐ体験を開始する</p>
                            </div>
                            <button class="w-100 mb-2 btn btn-custom" type="submit">エントリー</button>
                            <small class="text-body-secondary">By clicking Entry, you agree to the terms of use.</small>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        {{-- トースト --}}
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

        {{-- フッター --}}
        <footer class="text-center mt-4">
            <p>© 2024 anime_station</p>
        </footer>
    </body>
</html>
