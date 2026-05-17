<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="success-page">

<div class="success-container">

    <!-- HEADER -->

    <div class="success-header">

        <div>
            <h1>Keranjang</h1>
            <span>0 item</span>
        </div>

        <a href="/home" class="close-btn">
            ✕
        </a>

    </div>

    <!-- ICON -->

    <div class="success-icon">
        ✔
    </div>

    <!-- TEXT -->

    <h1 class="success-title">
        Pesanan Berhasil!
    </h1>

    <p class="success-subtitle">
        Pesanan #{{ $order->id }} telah dibuat
    </p>

    <!-- DETAIL -->

    <div class="success-box">

        <div class="success-row">
            <span>Status</span>
            <b class="orange">
                Menunggu Pembayaran
            </b>
        </div>

        <div class="success-row">
            <span>Metode</span>
            <b>
                {{ $order->payment_method }}
            </b>
        </div>

        <div class="success-row">
            <span>Total</span>
            <b class="orange">
                Rp {{ number_format($order->total) }}
            </b>
        </div>

    </div>

    <p class="detail-text">
        Lihat detail pesanan di halaman Orders
    </p>

    <!-- BUTTON -->

    <a href="/orders" class="menu-btn">
    Lihat Pesanan
</a>
</div>

</body>
</html>