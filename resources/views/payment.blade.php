<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="payment-page">

<div class="payment-container">

    <div class="payment-header">

        <h1>Pembayaran</h1>

        <a href="/cart">✕</a>

    </div>

    <form action="/payment/process" method="POST">

        @csrf

        <!-- METODE -->

        <div class="method-list">

            <label class="method-card">

                <input type="radio"
                       name="payment_method"
                       value="Cash"
                       checked>

                <div>
                    <h2>Cash</h2>
                    <p>Bayar langsung</p>
                </div>

            </label>

            <label class="method-card">

                <input type="radio"
                       name="payment_method"
                       value="E-Wallet">

                <div>
                    <h2>E-Wallet</h2>
                    <p>OVO, Dana, GoPay</p>
                </div>

            </label>

            <label class="method-card">

                <input type="radio"
                       name="payment_method"
                       value="Kartu">

                <div>
                    <h2>Kartu Debit/Kredit</h2>
                    <p>Visa, Mastercard</p>
                </div>

            </label>

        </div>

        <!-- RINGKASAN -->

        <div class="summary-box">

            <h2>Ringkasan Pesanan</h2>

            @php
                $total = 0;
            @endphp

            @foreach($order->items as $item)

                @php
                    $subtotal = $item->price * $item->quantity;
                    $total += $subtotal;
                @endphp

                <div class="summary-item">

                    <span>
                        {{ $item->quantity }}x
                        {{ $item->product->name }}
                    </span>

                    <span>
                        Rp {{ number_format($subtotal) }}
                    </span>

                </div>

            @endforeach

            <div class="summary-total">

                <h3>Total</h3>

                <h1>
                    Rp {{ number_format($total) }}
                </h1>

            </div>

        </div>

        <!-- BUTTON -->

        <div class="payment-footer">

            <a href="/cart" class="back-btn">
                Kembali
            </a>

            <button type="submit" class="pay-btn">

                Bayar Rp {{ number_format($total) }}

            </button>

        </div>

    </form>

</div>

</body>
</html>