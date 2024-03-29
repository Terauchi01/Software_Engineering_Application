<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ログイン</title>
        <link rel="stylesheet" href="{{ asset('/css/admin/AdminLogin.css') }}">
        <!-- cssはAdminのものを共用 -->
    </head>
    <body>
        <div class="login">
            <div class="sys_name">
                AeroNet
            </div>

            @if($errors->has('login'))
            <div>
                {{ $errors->first('login') }}
            </div>
            @endif
            <form action="{{ route('user.userLoginFunction') }}" method="POST" class="login_form">
                @csrf
                <input type="text" name="email_address" placeholder="メールアドレス" required>
                <input type="password" name="password" placeholder="パスワード" required>
                <button type="submit" class="login_">ログイン</button>
            </form>
            <a href="{{ route('user.userRegisterView') }}" class="new">新規登録する</a>
        </div>
    </body>
</html>
