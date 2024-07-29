<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function create(Category $category)
    {
        return view('products.create', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url', // Validate as URL instead of image
        ]);

        $productData = $request->all();

        // Store image URL directly
        $productData['image'] = $request->input('image');

        $category->products()->create($productData);

        return redirect()->route('categories.show', $category->id)->with('success', 'Product created successfully.');
    }

    public function edit(Category $category, Product $product)
    {
        return view('products.edit', compact('category', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate request data as needed
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url', // Validate as URL
        ]);

        // Update product details
        $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'image' => $validatedData['image'], // Update image URL
        ]);

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroy(Category $category, Product $product)
    {
        $product->delete();

        return redirect()->route('categories.show', $category->id)->with('success', 'Product deleted successfully.');
    }
}
