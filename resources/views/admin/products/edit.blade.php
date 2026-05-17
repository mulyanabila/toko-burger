<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="create-page">

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

<!-- FORM -->

<div class="create-container">

    <div class="create-card">

        <h1>Edit Produk</h1>

        <form action="/admin/products/update/{{ $product->id }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- IMAGE -->
            <img
                src="{{ asset('images/' . $product->image) }}"
                class="preview-img"
            >

            <!-- NAMA -->
            <div class="form-group">

                <label>Nama Produk</label>

                <input type="text"
                       name="name"
                       value="{{ $product->name }}">

            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">

                <label>Deskripsi</label>

                <textarea name="description">{{ $product->description }}</textarea>

            </div>

            <!-- HARGA -->
            <div class="form-group">

                <label>Harga</label>

                <input type="number"
                       name="price"
                       value="{{ $product->price }}">

            </div>

            <!-- STOCK -->
            <div class="form-group">

                <label>Stock</label>

                <input type="number"
                       name="stock"
                       value="{{ $product->stock }}">

            </div>

            <!-- IMAGE -->
            <div class="form-group">

                <label>Ganti Gambar</label>

                <input type="file" name="image">

            </div>

            <button type="submit" class="save-btn">
                Update Produk
            </button>

        </form>

    </div>

</div>

</body>
</html>