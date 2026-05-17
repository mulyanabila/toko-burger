<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

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

        <h2>Buat Akun</h2>

        <p>
            Daftar sekarang dan nikmati burger premium favoritmu 🍔
        </p>

    </div>

    <!-- FORM -->

    <form action="/register" method="POST">

        @csrf

        <div class="form-group">

            <label>Nama</label>

            <input
                type="text"
                name="name"
                placeholder="Masukkan nama"
                required
            >

        </div>

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
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
            Register
        </button>

    </form>

    <!-- LOGIN -->

    <div class="register">

        Sudah punya akun?

        <a href="/login">
            Login
        </a>

    </div>

</div>

</body>
</html>