<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="orders-page">

<!-- NAVBAR -->
<nav class="navbar">

    <div class="logo">
        BURGER KINGDOM
    </div>

    <ul class="nav-links">

        <li>
            <a href="/menu">Menu</a>
        </li>

        <li>
            <a href="/cart">Cart</a>
        </li>

        <li>
            <a href="/orders">Orders</a>
        </li>

        <li>
            <a href="/about">About</a>
        </li>

    </ul>

   <a href="/logout" class="profile-box">

    <span class="profile-name">
        {{ Auth::user()->name }}
    </span>

</a>

</div>

</nav>

<div class="orders-container">

    <!-- HEADER -->

    <div class="orders-header">

        <div>
            <h1>PESANAN SAYA</h1>
            <p>Burger Kingdom</p>
        </div>

    </div>

    <!-- INFO -->

    <div class="tracking-box">

        <h2>Track Pesanan Anda</h2>

        <p>
            Pantau status pesanan Anda secara real-time.
        </p>

    </div>

    <!-- LIST ORDER -->

    @foreach($orders as $order)

    <div class="order-card">

        <!-- TOP -->

        <div class="order-top">

            <div>

                <h2>
                    Order #{{ $order->id }}
                </h2>

                <p>
                    {{ \Carbon\Carbon::parse($order->created_at)
                    ->timezone('Asia/Jakarta')
                    ->locale('id')
                    ->translatedFormat('d F Y \\p\\u\\k\\u\\l H.i') }}
                </p>

                <div class="payment-info">

                    <span>
                        {{ $order->payment_method }}
                    </span>

                    <b>
                        Rp {{ number_format($order->total) }}
                    </b>

                </div>

            </div>

            <div class="status-badge">
                Menunggu Pembayaran
            </div>

        </div>

        <!-- DETAIL -->

        <div class="detail-box">

            <h3>Detail Pesanan:</h3>

            @foreach($order->items as $item)

            <div class="item-row">

                <div class="item-left">

                    <img
                        src="{{ asset('images/' . $item->product->image) }}"
                        class="order-img"
                    >

                    <div>

                        <h2>
                            {{ $item->product->name }}
                            ×{{ $item->quantity }}
                        </h2>

                        <p class="note">
                            {{ $item->note }}
                        </p>

                    </div>

                </div>

                <h2>
                    Rp {{ number_format($item->price * $item->quantity) }}
                </h2>

            </div>

            @endforeach

        </div>

        <!-- FOOTER -->

        <div class="order-footer">

            <p>
                Pesanan dapat dibatalkan sebelum diproses
            </p>

            <a href="/cancel/{{ $order->id }}" class="cancel-btn">
                Batalkan
            </a>

        </div>

    </div>

    @endforeach

</div>

</body>
</html>