<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ログアウト</title>
        <link rel="stylesheet" href="{{ asset('/css/admin/AdminLogout.css') }}">
    </head>
    <body>
        <div class="logout">
            <form action="{{ route('user.userLogoutFunction') }}" method="POST" class="logout_form">
                @csrf
                <p>ログアウトしますか</p>
                <button type="submit" name="logout" value="true">ログアウト</button>
                <button type="submit" name="logout" value="false">トップへ戻る</button>
            </form>
        </div>
    </body>
</html>
