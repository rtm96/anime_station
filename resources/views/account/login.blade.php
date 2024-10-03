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
    <link rel="stylesheet" href="{{asset('/css/style_account.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>ログイン / anime_station</title>
</head>
    <body>
        {{-- トップ画面 --}}
        <h1>あなたの中に<br/>眠る創造を、<br/>解き放つ場所</h1>
        <h2>anime<br/>station</h2>
        <div class="d-grid gap-2 col-3 mx-auto">
            <label>いますぐエントリー</label>
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#createModal">アカウント作成</button>
                <p class="p-select">or</p>
            <label>アカウントをお持ちの方はこちら</label>
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal">ログイン</button>
        </div>

        {{-- アカウント作成モーダル表示 --}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
            <div>
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h4 class="fw-bold mb-0 fs-2">アカウントを作成</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form class="">
                        <div class="form-floating mb-4">
                            <input type="name" class="form-control rounded-3" id="floatingInput" placeholder="name" autofocus>
                            <label for="floatingInput" class="label-color">ユーザーネーム</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput" class="label-color">メールアドレス</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="label-color">パスワード</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="label-color">パスワード確認</label>
                        </div>
                        <div>
                            <p class="p-modal">入力した内容で登録する</p>
                        </div>
                        <button class="w-100 mb-2 btn btn-custom" type="button" data-bs-toggle="modal" data-bs-target="#iconModal">次へ</button>
                        <small class="text-body-secondary">By clicking Entry, you agree to the terms of use.</small>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>

        {{-- アイコン画像選択モーダル表示 --}}
        <div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModal" aria-hidden="true">
            <div>
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h4 class="fw-bold mb-0 fs-2">アイコンを選択する</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form class="">
                        <img src="/img/default-icon.jpg" class="rounded-circle" alt="" width="200" height="200">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">このアイコン画像に決定</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <button class="w-100 mb-2 btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">スキップする</button>
                        <button class="w-100 mb-2 btn btn-custom" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">次へ</button>
                        <small class="text-body-secondary">By clicking Entry, you agree to the terms of use.</small>
                        </form>
                    </div>
                </div>
            </div>
            </div>
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
                    <div class="modal-body p-5 pt-0">
                        <form class="">
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput" class="label-color">メールアドレス</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="label-color">パスワード</label>
                        </div>
                        <div>
                            <p class="p-modal">いますぐ体験を開始する</p>
                        </div>
                        <button class="w-100 mb-2 btn btn-custom" type="button">エントリー</button>
                        <small class="text-body-secondary">By clicking Entry, you agree to the terms of use.</small>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>

        {{-- フッター --}}
        <footer class="text-center mt-4">
            <p>© 2024 anime_station</p>
        </footer>
    </body>
</html>
