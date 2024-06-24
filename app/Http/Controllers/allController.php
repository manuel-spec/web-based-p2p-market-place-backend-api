<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class allController extends Controller
{
    //
    public function index()
    {
        // return response()->json(['message' => 'Display all products.']);
        $products = Product::all();
        return response()->json($products);
    }
    public function updateStatus(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        
        $product->status = $request->input('status');
        $product->save();
        
        return response()->json(['message' => 'Product status updated successfully.']);
    }
}
