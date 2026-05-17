<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Admin Products</h1>

<a href="/admin/products/create">
    Tambah Menu
</a>

<table border="1" cellpadding="10">

<tr>
    <th>Foto</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stock</th>
    <th>Aksi</th>
</tr>

@foreach($products as $p)

<tr>

    <td>
        <img src="{{ asset('images/' . $p->image) }}" width="100">
    </td>

    <td>{{ $p->name }}</td>

    <td>Rp {{ number_format($p->price) }}</td>

    <td>{{ $p->stock }}</td>

    <td>

        <a href="/admin/products/edit/{{ $p->id }}">
            Edit
        </a>

        |

        <a href="/admin/products/delete/{{ $p->id }}">
            Delete
        </a>

    </td>

</tr>

@endforeach

</table>
</body>
</html>