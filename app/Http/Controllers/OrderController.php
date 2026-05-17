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
        $note = "";

        // IF ELSE
        if ($request->telur) {
            $harga += 5000;
            $note .= " + Double Telur";
        }

        if ($request->keju) {
            $harga += 4000;
            $note .= " + Double Keju";
        }

        if ($request->tanpa_sayur) {
            $note .= " - Tanpa Sayur";
        }

        if ($request->extra_saus) {
            $harga += 2000;
            $note .= " + Extra Saus";
        }

        $order = Order::firstOrCreate([
            'user_id' => Auth::id(),
            'status' => 'cart'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => 1,
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

            if ($product->stock < $item->qty) {
                return back();
            }

            $product->stock -= $item->quantity;
            $product->save();
        }

        $order->status = 'ordered';
        $order->total = $order->items->sum(fn($i) => $i->price * $i->qty);
        $order->save();

        return redirect('/cart');
    }

    public function delete($id)
{
    $item = OrderItem::findOrFail($id);

    $item->delete();

    return back();
}

    // PAYMENT
    public function pay($id)
    {
        $order = Order::find($id);
        $order->status = 'paid';
        $order->save();

        return redirect('/');
    }
}

