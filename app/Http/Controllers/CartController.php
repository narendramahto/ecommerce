<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add to cart
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        
        // Check if stock is available
        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }

        // Add item to cart
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->quantity = $request->quantity;
        $cart->price = $product->price;
        $cart->total_price = $product->price*$request->quantity;
        $cart->save();

        return response()->json(['message' => 'Product added to cart']);
    }

    // View cart
    public function index()
    {
        $cart = auth()->user()->cartItems;
        return response()->json($cart);
    }
}

