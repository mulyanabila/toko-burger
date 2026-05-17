<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Menu</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="admin-page">

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        BURGER KINGDOM
    </div>

    <ul class="nav-links">

        <li><a href="/menu">Menu</a></li>

        <li><a href="/admin/orders">Orders</a></li>

    </ul>

    <a href="/logout" class="profile-box">
        Admin
    </a>

</nav>

<!-- HEADER -->

<div class="admin-header">

    <h1>DATA MENU</h1>

    <a href="/admin/products/create" class="add-btn">
        + Tambah Menu
    </a>

</div>

<!-- PRODUCT GRID -->

<div class="admin-grid">

@foreach($products as $product)

    <div class="admin-card">

        <!-- IMAGE -->
        <img
            src="{{ asset('images/' . $product->image) }}"
            class="admin-img"
        >

        <!-- INFO -->
        <div class="admin-info">

            <h2>
                {{ $product->name }}
            </h2>

            <p>
                {{ $product->description }}
            </p>

            <div class="price-stock">

                <span>
                    Rp {{ number_format($product->price) }}
                </span>

                <b>
                    Stock: {{ $product->stock }}
                </b>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="admin-action">

            <a href="/admin/products/edit/{{ $product->id }}"
               class="edit-btn">
                Edit
            </a>

            <a href="/admin/products/delete/{{ $product->id }}"
                class="delete-btn-admin"
                onclick="return confirm('Yakin ingin menghapus menu ini?')">
                Delete
            </a>

        </div>

    </div>

@endforeach

</div>

</body>
</html>