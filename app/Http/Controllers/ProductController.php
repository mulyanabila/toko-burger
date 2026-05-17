<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{

    // HALAMAN MENU
    public function index()
    {
        $products = Product::all();

        return view('home', compact('products'));
    }

    // HALAMAN ADMIN
public function admin()
{
    if(Auth::user()->role != 'admin')
    {
        return redirect('/home');
    }

    $products = Product::all();
    return view('admin.products', compact('products'));
}

// FORM TAMBAH
public function create()
{
    return view('admin.products.create');
}

// SIMPAN PRODUK
public function store(Request $request)
{
    $imageName = time().'.'.$request->image->extension();

    $request->image->move(public_path('images'), $imageName);

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'stock' => $request->stock,
        'description' => $request->description,
        'image' => $imageName
    ]);

    return redirect('/admin/products');
}

// FORM EDIT
public function edit($id)
{
    $product = Product::findOrFail($id);

    return view('admin.products.edit', compact('product'));
}

// UPDATE
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    if($request->hasFile('image'))
    {
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $product->image = $imageName;
    }

    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;
    $product->save();

    return redirect('/admin/products');
}

// DELETE
public function delete($id)
{
    Product::destroy($id);

    return redirect('/admin/products');
}
}