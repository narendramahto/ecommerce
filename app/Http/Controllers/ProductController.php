<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Get single product details
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required|unique:products",
            "price"=>"required",
            "description"=>"required",
            "stock"=>"required",
        ]);
        $request->merge([
            'created_at'=>now()
        ]);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'created_at' => $request->created_at,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
            ], 200);
    }
}

