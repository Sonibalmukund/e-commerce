<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['count' => count($cart)]);
    }

    public function cart()
    {
        $cart = session('cart', []);
        return view('checkout.cart', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'phone' => 'required'
        ]);

        $cart = session('cart', []);
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'total' => $total,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Send confirmation email
        Mail::to($order->email)->send(new OrderConfirmationMail($order));


        session()->forget('cart');
        return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    }
    public function remove(Request $request)
{
    $cart = session()->get('cart', []);
    $productId = $request->product_id;

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    return response()->json([
        'status' => 'success',
        'count' => count($cart)
    ]);
}

}

