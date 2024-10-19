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
    <link rel="stylesheet" href="{{asset('/css/style_profile.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>プロフィール / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

<div class="content">
    <div class="position-absolute">
        {{-- DBに格納した画像データを再変換して表示 --}}
        @if($user->image)
        <img src="data:image/png;base64,{{$user->image }}" class="rounded-circle" alt="" width="200" height="200">
        @else
        <img src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle" alt="" width="200" height="200">
        @endif
    </div>

    <div class="row name">
        <p class="userName">{{ Auth::user()->name}}</p>
    </div>

    <a href="/profile/edit" class="btn btn-custom profile">編集</a>

    <div class="follow">
        <strong>総いいね数　{{ $likesCount }}</strong></br>
        <strong>　</strong>
    </div>

    <div class="col-7 detail">
        <div data-bs-spy="scroll" data-bs-target="#list" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
            <p class="p-detail">
                {{ $user->detail }}
            </p>
        </div>
    </div>

    <div class="col-2">
        投稿一覧
    </div>

    <div class="col-11">
        <hr>
    </div>

    {{-- カード --}}
    <div class="row justify-content-center"> <div class="col-md-11">
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
                        <th>　</th>
                        <div class="col-title">
                        <th scope="col-title">動画詳細</th>
                        </div>
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
                        <td>　</td>
                        <td class="td-card ms-0">

                        <div class="card mx-0" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $item->title }}</h6>
                                        <div class="flex-taxt">
                                        <p class="user-update">更新者：{{ $item->name }}</p>
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

                        
                        <td scope="row" class="row-word"><p class="card-day2">{{ $item->likesCount() }}いいね</p></td>
                        <td scope="row" class="row-word"><p class="card-day1"><span>{{ $item->updated_at->format('Y') }}</span><br/>{{ $item->updated_at->format('m/d') }}</p></td>
                        <td scope="row" class="row-word"><p class="card-day2">{{ $genres[$item->type] ?? '未分類' }}</p></td>
                        <td scope="row" class="row-word"><p class="card-day3">
                            @if(($user->auth === 0 && $item->user_id === $user->id) || $user->auth === 1)
                            <a href="{{route('video.edit',$item->id)}}" class="btn btn-sm btn-custom post">
                                編集
                            </a>
                            @endif
                            </p>
                        </td>

                    </tr>

                    </tbody>
                    @endforeach
                </table>


                <div class="modal-footer">
                    <a class="btn btn-secondary page" class="icon-link icon-link-hover" href="#" role="button">
                        ↑
                    </a>

                    <div class="pagination justify-content-center mt-4">
                        {{ $items->links('pagination::bootstrap-4') }}
                    </div>
                </div>
    

        </div></div></div>
    </div>

</div>

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

</div>
{{-- @endforeach --}}

</div>

</body>
</html>