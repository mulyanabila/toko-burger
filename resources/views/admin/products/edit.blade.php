<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Produk</h1>

<form action="/admin/products/update/{{ $product->id }}"
method="POST"
enctype="multipart/form-data">

    @csrf

    <input type="text"
    name="name"
    value="{{ $product->name }}">

    <br><br>

        <textarea
            name="description"
            placeholder="Deskripsi"
            rows="4"
            cols="40"
        >{{ $product->description }}</textarea>

    <input type="number"
    name="price"
    value="{{ $product->price }}">

    <br><br>

    <input type="number"
    name="stock"
    value="{{ $product->stock }}">

    <br><br>

    <img src="{{ asset('images/' . $product->image) }}"
    width="120">

    <br><br>

    <input type="file" name="image">

    <br><br>

    <button type="submit">
        Update
    </button>

</form>
</body>
</html>