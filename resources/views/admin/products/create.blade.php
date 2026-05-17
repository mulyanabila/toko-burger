<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk</title>

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

        <h1>Tambah Produk</h1>

        <form action="/admin/products/store"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- NAMA -->
            <div class="form-group">

                <label>Nama Produk</label>

                <input type="text"
                       name="name"
                       placeholder="Masukkan nama burger">

            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">

                <label>Deskripsi</label>

                <textarea name="description"
                          placeholder="Deskripsi burger"></textarea>

            </div>

            <!-- HARGA -->
            <div class="form-group">

                <label>Harga</label>

                <input type="number"
                       name="price"
                       placeholder="Masukkan harga">

            </div>

            <!-- STOCK -->
            <div class="form-group">

                <label>Stock</label>

                <input type="number"
                       name="stock"
                       placeholder="Masukkan stock">

            </div>

            <!-- IMAGE -->
            <div class="form-group">

                <label>Gambar Produk</label>

                <input type="file" name="image">

            </div>

            <!-- BUTTON -->
            <button type="submit" class="save-btn">
                Simpan Produk
            </button>

        </form>

    </div>

</div>

</body>
</html>