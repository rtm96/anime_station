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
    <link rel="stylesheet" href="{{asset('/css/style_indexUser.css')}}">

    {{-- font --}}
    <link href="https://fonts.cdnfonts.com/css/borgen" rel="stylesheet">

    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>アカウント一覧 / anime_station</title>
</head>
<body>
<div class="container">
@include('parts.nav')


<div class="content">
    <h3>アカウント一覧</h3>
    <div class="create-form"> 

        <!-- 検索フォーム -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="ユーザー名で検索">
            </div>
        </div>

        <!-- ユーザー一覧テーブル -->
        <form id="bulk-delete-form" action="{{ route('users.bulkDelete') }}" method="POST" onsubmit="return confirmDeletion()">
            @csrf
            <div class="table-responsive col-11">
                <table class="table table-hover table-striped table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col"><input type="checkbox" id="select-all"></th>
                            <th scope="col">ID</th>
                            <th scope="col">ユーザーネーム</th>
                            <th scope="col">メールアドレス</th>
                            <th scope="col">権限</th>
                            <th scope="col">登録日</th>
                            <th scope="col">更新日</th>
                            <th scope="col">操作</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="user_ids[]" value="#" class="form-check-input"></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->auth == 1 ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ $user->auth == 1 ? '管理者' : 'ユーザー' }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-custom">編集</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- 選択したユーザーを削除ボタン -->
            <button type="submit" class="btn btn-secondary mt-3">選択したユーザーを削除</button>
        </form>

        <!-- ページネーション -->
        <div class="d-flex justify-content-end mt-4">
            {{ $users->links('pagination::bootstrap-4') }} 
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

    <!-- 検索機能スクリプト -->
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#user-table-body tr');
            rows.forEach(row => {
                const userName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                row.style.display = userName.includes(searchTerm) ? '' : 'none';
            });
        });

        // 確認ダイアログを表示するスクリプト
        function confirmDeletion() {
            return confirm('選択したアカウントを削除してもよろしいですか？');
        }
    </script>

</div>

</body>
</html>