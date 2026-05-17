<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">

<div class="login-box">

    <!-- LOGO -->

    <div class="logo">

        <div class="logo-icon">
            🍔
        </div>

        <div class="logo-text">
            <h1>BURGER KINGDOM</h1>
            <span>Premium Burgers</span>
        </div>

    </div>

    <!-- WELCOME -->

    <div class="welcome">

        <h2>Selamat Datang!</h2>

        <p>
            Masuk ke akun Anda untuk memesan burger favorit
        </p>

    </div>

    <!-- FORM LOGIN -->

    <form action="/login" method="POST">

        @csrf

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email anda"
                required
            >

        </div>

        <div class="form-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

        </div>

        <button type="submit" class="login-btn">
            Masuk
        </button>

    </form>

    <!-- REGISTER -->

    <div class="register">

        Belum punya akun?

        <a href="/register">
            Daftar disini
        </a>

    </div>

</div>

</body>
</html>