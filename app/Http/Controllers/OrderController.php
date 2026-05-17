<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

class OrderController extends Controller
{
    
    // ADD TO CART + IF ELSE TOPPING
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock < 1) {
            return back()->with('error', 'Stok habis');
        }

        $harga = $product->price;
        $note = $request->note ?? '';

        // TOPPING & REQUEST

        if ($request->telur) {
            $harga += 5000;
            $note .= " + Tambah Telur";
        }

        if ($request->keju) {
            $harga += 4000;
            $note .= " + Tambah Keju";
        }

        if ($request->double_telur) {
            $harga += 10000;
            $note .= " + Double Telur";
        }

        if ($request->double_keju) {
            $harga += 6000;
            $note .= " + Double Keju";
        }

        if ($request->double_cheese) {
            $harga += 12000;
            $note .= " + Double Cheese";
        }

        if ($request->extra_saus) {
            $harga += 2000;
            $note .= " + Extra Saus";
        }

        if ($request->tanpa_sayur) {
            $note .= " - Tanpa Sayur";
        }

        if ($request->tanpa_tomat) {
            $note .= " - Tanpa Tomat";
        }

        if ($request->tanpa_saus) {
            $note .= " - Tanpa Saus";
        }

        $order = Order::firstOrCreate([
            'user_id' => Auth::id(),
            'status' => 'cart'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => $request->quantity,
            'price' => $harga,
            'note' => $note
        ]);

        return redirect('/cart');
    }

    // VIEW CART
        public function cart()
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'cart')
            ->first();

        return view('cart', compact('order'));
    }

    // CHECKOUT
    public function checkout()
    {
        $order = Order::where('user_id', Auth::id())
        ->where('status', 'cart')
        ->first();

        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);

            if ($product->stock < $item->quantity) {
                return back();
            }

            $product->stock -= $item->quantity;
            $product->save();
        }

        $order->status = 'ordered';
        $order->total = $order->items->sum(fn($i) => $i->price * $i->quantity);
        $order->save();

        return redirect('/cart');
    }

    public function delete($id)
{
    $item = OrderItem::findOrFail($id);

    $item->delete();

    return back();
}

    public function increaseQty($id)
    {
        $item = OrderItem::findOrFail($id);
        $product = Product::findOrFail($item->product_id);

        if ($product->stock < 1) {
            return back()->with('error', 'Stok habis');
        }

        $item->quantity += 1;
        $item->save();

        return back();
    }

    public function decreaseQty($id)
    {
        $item = OrderItem::findOrFail($id);

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }

        return back();
    }

   public function payment()
{
    $order = Order::where('user_id', Auth::id())
        ->where('status', 'cart')
        ->first();

    return view('payment', compact('order'));
}

public function processPayment(Request $request)
{
    $order = Order::where('user_id', Auth::id())
        ->where('status', 'cart')
        ->first();

    foreach ($order->items as $item) {

        $product = Product::find($item->product_id);

        if ($product->stock < $item->quantity) {
            return back();
        }

        $product->stock -= $item->quantity;
        $product->save();
    }

    $order->status = 'paid';

    $order->payment_method = $request->payment_method;

    $order->total = $order->items->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    $order->save();

    return redirect('/success/' . $order->id);
}

public function success($id)
{
    $order = Order::findOrFail($id);

    return view('success', compact('order'));
}

public function orders()
{
    $orders = Order::where('user_id', Auth::id())
        ->where('status', 'paid')
        ->latest()
        ->get();

    return view('orders', compact('orders'));
}

public function cancel($id)
{
    $order = Order::findOrFail($id);

    // kembalikan stok
    foreach ($order->items as $item) {

        $product = Product::find($item->product_id);

        $product->stock += $item->quantity;

        $product->save();
    }

    // hapus order item
    $order->items()->delete();

    // hapus order
    $order->delete();

    return redirect('/orders')
        ->with('success', 'Pesanan berhasil dibatalkan');
}

public function adminOrders()
{
    $orders = Order::where('status', 'paid')
        ->latest()
        ->get();

    return view('admin.orders', compact('orders'));
}

}
