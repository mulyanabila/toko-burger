<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="orders-page">

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        BURGER KINGDOM
    </div>

    <ul class="nav-links">

        <li><a href="/admin/products">Menu</a></li>

        <li><a href="/admin/orders">Orders</a></li>

    </ul>

    <a href="/logout" class="profile-box">
        Admin
    </a>

</nav>

<div class="orders-container">

    <h1>TRACK PESANAN CUSTOMER</h1>

    @foreach($orders as $order)

    <div class="order-card">

        <!-- HEADER -->

        <div class="order-top">

            <div>

                <h2>
                    Order #{{ $order->id }}
                </h2>

                <p>
                    Customer:
                    <b>{{ $order->user->name }}</b>
                </p>

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
                Pesanan Diproses
            </div>

        </div>

        <!-- DETAIL -->

        <div class="detail-box">

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

        <!-- REQUEST CUSTOMER -->
        <div class="request-tags">

            @foreach(explode('+', str_replace('-', '+', $item->note)) as $note)

                @if(trim($note) != '')

                <span class="tag">
                    {{ trim($note) }}
                </span>

                @endif

            @endforeach

        </div>

    </div>

</div>

<h2>
    Rp {{ number_format($item->price * $item->quantity) }}
</h2>
            </div>

            @endforeach

        </div>

    </div>

    @endforeach

</div>

</body>
</html>