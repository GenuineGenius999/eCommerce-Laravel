<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'total' => $product->final_price * $details['quantity']
                ];
                $total += $product->final_price * $details['quantity'];
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.'
            ]);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] = [
                'quantity' => $request->quantity,
                'price' => $product->final_price
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => count($cart)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session()->get('cart', []);

        if ($request->quantity == 0) {
            unset($cart[$request->product_id]);
        } else {
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!'
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart!'
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }
} 