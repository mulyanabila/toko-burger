<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="cart-page">

<div class="cart-container">

    <!-- HEADER -->

    <div class="cart-header">

        <div>
            <h1>Keranjang</h1>

            <span>
                {{ $order ? $order->items->count() : 0 }} item
            </span>
        </div>

        <a href="/home" class="close-btn">
            ✕
        </a>

    </div>

    <!-- ITEMS -->

    <div class="cart-items">

        @php
            $total = 0;
        @endphp

        @if($order)

            @foreach($order->items as $item)

            @php
                $subtotal = $item->price * $item->quantity;
                $total += $subtotal;
            @endphp

            <div class="cart-card">

                <img
                    src="{{ asset('images/' . $item->product->image) }}"
                    class="cart-img"
                >

                <div class="cart-detail">

                    <h2>
                        {{ $item->product->name }}
                    </h2>

                    <p class="note">
                        {{ $item->note }}
                    </p>

                    <div class="qty-box">

                        <button>-</button>

                        <span>
                            {{ $item->quantity }}
                        </span>

                        <button>+</button>

                    </div>

                </div>

                <div class="price-box">

    <!-- DELETE -->
    <form action="/cart/item/{{ $item->id }}" method="POST">

        @csrf
        @method('DELETE')

        <button type="submit" class="delete-btn">
            🗑
        </button>

    </form>

    <p>
        Rp {{ number_format($subtotal) }}
    </p>

</div>
                </div>

            </div>

            @endforeach

        @endif

    </div>

    <!-- FOOTER -->

    <div class="cart-footer">

        <div class="total-box">

            <span>Total</span>

            <h1>
                Rp {{ number_format($total) }}
            </h1>

        </div>

        <button class="checkout-btn">
            Lanjut ke Pembayaran
        </button>

    </div>

</div>

</body>
</html>