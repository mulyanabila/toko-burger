<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>DATA MENU</h1>

<a href="/admin/products/create">
    Tambah Menu
</a>

<table border="1" cellpadding="10">

<tr>
    <th>Nama</th>
    <th>Deskripsi</th>
    <th>Harga</th>
    <th>Stock</th>
    <th>Action</th>
</tr>

@foreach($products as $p)

<tr>

    <td>{{ $p->name }}</td>
    <td>{{ $p->description }}</td>
    <td>{{ $p->price }}</td>
    <td>{{ $p->stock }}</td>

    <td>

        <a href="/admin/products/edit/{{ $p->id }}">
            Edit
        </a>

        <a href="/admin/products/delete/{{ $p->id }}">
            Delete
        </a>

    </td>

</tr>

@endforeach

</table>
</body>
</html>