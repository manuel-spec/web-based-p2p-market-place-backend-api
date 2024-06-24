<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreProductRequest $request, Product $product)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, Product $product)
    {
        $validatedData = $request->validate([
            'image' => ['required', 'image'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ], [
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
        ]);
    
        try {
          
    
            // Store the image and get the file name
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            Storage::disk('public')->put($imagePath, file_get_contents($request->file('image')));
            
            $user = auth()->user();
            $product->fill([
                'image' => $imageName,
                'user_id' => $user->id,
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
            ]);
    
            $product->save();

    
            return response()->json(['message' => 'Product created successfully'], 201);
        } catch (\Exception $e) {
    
            return response()->json(['error' => 'Product creation failed', 'message' => $e->getMessage()], 500);
        }
    }
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
