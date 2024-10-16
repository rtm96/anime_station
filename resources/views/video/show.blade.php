<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- いいねのCSRFトークン --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://getbootstrap.jp/docs/5.3/assets/css/docs.css" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{asset('/css/style_showVideo.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>


    <title>視聴画面 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')

    <div class="content"> 

        {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/GtYV_F71yeE?si=fK7QIV9f3aaHwnT1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
        <iframe width="560" height="315" src="{{ $item->videoURL }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        <div class="videoTitle">
            {{ $item->title }}
        </div>

        <div class="user-data">
            {{-- <img src="{{ Auth::user()->image ? asset('/storage/img/'.Auth::user()->image) : asset('/img/default-icon.jpg')}}" alt="" width="32" height="32" class="rounded-circle video"> --}}
            @if($user->image)
            <img id="icon_img_prv" name='image' src="data:image/png;base64,{{$user->image }}" class="rounded-circle video" alt="" width="32" height="32">
            @else
            <img id="icon_img_prv" name='image' src="{{ asset('/img/default-icon.jpg') }}" class="rounded-circle video" alt="" width="32" height="32">
            @endif
            {{-- <strong class="profile-name float-start">{{ Auth::user()->name}}</strong> --}}
            <strong class="profile-name float-start">{{ $user->name }}</strong>

            <strong class="profile-name float-end">いいね</strong>
        </div>

        <div class="btn-position">
            <svg xmlns="http://www.w3.org/2000/svg" style="color: #0dc5d2" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
            </svg>
        </div>

        {{-- いいね機能実装 --}}
        <div class="btn-position">
            <form action="{{ $item->likeByUser ? route('unlike', ['itemId' => $item->id]) : route('like', ['itemId' => $item->id]) }}" method="POST" class="like-form">
                @csrf
                @if($item->likeByUser)
                    @method('DELETE')
                @endif
                <button type="submit" class="like-btn" style="border: none; background: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16" style="color: {{ $item->likeByUser ? '#0dc5d2' : 'inherit' }}">
                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                    </svg>
                </button>
                <span class="like-count">{{ $item->likes_count }}</span>
            </form>
        </div>


        <div class="col-6 detail">
            <div data-bs-spy="scroll" data-bs-target="#list" data-bs-smooth-scroll="true" tabindex="0" data-bs-root-margin="0px 0px -40%" class="scrollspy-example bg-body-tertiary p-2 rounded-2" style="height: 150px">
            <p class="text-detail">
                {{ $item->detail }}
            </p>
            </div>
        </div>

    </div>
</div>

{{-- いいね機能のスクリプト --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeForms = document.querySelectorAll('.like-form');
    
        likeForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
    
                const formData = new FormData(this);
                const url = this.action;
                const method = this.method;

                fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const likeCountElement = this.querySelector('.like-count');
                        likeCountElement.textContent = data.likes_count !== null ? data.likes_count : 'Error';

                        const likeIcon = this.querySelector('svg');
                        if (data.liked) {
                            likeIcon.style.color = '#0dc5d2';  // いいねされた場合（色を付ける）
                        } else {
                            likeIcon.style.color = '';  // いいねが取り消された場合（色を元に戻す）
                        }

                        // フォームのアクションとメソッドの更新
                        this.action = data.liked ? 
                            `{{ route('unlike', ['itemId' => $item->id]) }}` : 
                            `{{ route('like', ['itemId' => $item->id]) }}`;
                        this.method = data.liked ? 'DELETE' : 'POST';
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>






</body>
</html>