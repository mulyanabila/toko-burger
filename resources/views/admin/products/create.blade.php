<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Produk</h1>

<form action="/admin/products/store" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="text" name="name" placeholder="Nama">

    <br><br>

    <textarea
        name="description"
        placeholder="Deskripsi"
        rows="4"
        cols="40"
    ></textarea>

    <input type="number" name="price" placeholder="Harga">

    <br><br>

    <input type="number" name="stock" placeholder="Stock">

    <br><br>

    <input type="file" name="image">

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>
</body>
</html>