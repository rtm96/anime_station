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
    <link rel="stylesheet" href="{{asset('/css/style_indexPost.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>投稿一覧 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

<div class="content">
    <h3>投稿動画一覧</h3>
    <div class="edit-form"> 

        {{-- 検索機能 --}}
        <form action="{{ route('video.index') }}" method="GET">
        <div class="search">
            <input class="form-control me-2" name="keyword" type="search" placeholder="検索" aria-label="Search">
            
            <button class="btn btn-outline-secondary" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
            {{-- クリア機能リンク --}}
            <a href="{{ url('/video') }}" class="btn btn-outline-secondary">クリア</a>
        </div>
        </form>

    <div class="row justify-content-center"> <div class="col-md-11">
        {{-- カード --}}
        <div class="card">
            <div class="card-header">
                <thead>
                    <strong class="strong title">Vboard</strong>
                </thead>
            </div>

            <div class="card-body">
            
                <table class="table">
                    <thead>
                    <tr>
                        {{-- <th><input type="checkbox" id="select-all"></th> --}}
                        <th>　</th>
                        <th scope="col-title">動画詳細</th>
                        <th scope="col-word">いいね数</th>
                        <th scope="col-word">更新日</th>
                        <th scope="col-word">公開設定</th>
                        <th scope="col-word">　</th>
                        <th><div></div></th>
                    </tr>
                    </thead>

                    @foreach ($items as $item)
                    <tbody>
                    <tr>
                        {{-- <td><input type="checkbox" name="item_ids[]" value="{{ $item->id }}" class="form-check-input"></td> --}}
                        <td>　</td>
                        <td class="td-card ms-0">

                        {{-- カード履歴 --}}
                        <div class="card mx-0" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $item->title }}</h6>
                                        <div class="flex-taxt">
                                        <p class="userName">更新者：{{ $item->name }}</p>
                                        </div>
                                        <p class="card-detail">
                                            {{ $item->detail }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('video.show', ['item' => $item] ) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                    </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        </td>

                        
                        <td scope="row" class="row-word"><p class="card-day2">10いいね</p></td>
                        <td scope="row" class="row-word"><p class="card-day1"><span>{{ $item->updated_at->format('Y') }}</span><br/>{{ $item->updated_at->format('m/d') }}</p></td>
                        <td scope="row" class="row-word"><p class="card-day2">{{ $genres[$item->type] ?? '未分類' }}</p></td>
                        <td scope="row" class="row-word"><p class="card-day3">
                            {{-- 管理ユーザーかつログインしたユーザーのみ投稿編集できる機能 --}}
                            {{-- @can('admin-or-myItem') --}}
                            @if(($user->auth === 0 && $item->user_id === $user->id) || $user->auth === 1)
                            <a href="{{route('video.edit',$item->id)}}" class="btn btn-sm btn-custom">
                                編集
                            </a>
                            @endif
                            {{-- @endcan --}}
                            </p>
                        </td>

                    </tr>

                    </tbody>
                    @endforeach
                </table>


                {{-- フッター --}}
                <div class="modal-footer">
                    <a class="btn btn-secondary page" class="icon-link icon-link-hover" href="#" role="button">
                        ↑
                    </a>

                    <!-- ページネーションリンクの表示 -->
                    <div class="pagination justify-content-center mt-4">
                        {{ $items->links('pagination::bootstrap-4') }}
                    </div>
                </div>{{-- フッター --}}
    

        </div></div></div>
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

</body>
</html>