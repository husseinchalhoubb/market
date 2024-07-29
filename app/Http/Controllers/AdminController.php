<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $offers = Offer::all();
        return view('admin.index', compact('categories', 'offers'));
    }

    // Category management
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    // Product management
    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url', // Validate as URL instead of image file
        ]);

        $productData = $request->all();

        // Store image URL directly
        $productData['image'] = $request->input('image');

        Product::create($productData);

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url', // Validate as URL
        ]);

        $productData = $request->all();

        // Update image URL directly
        $productData['image'] = $request->input('image');

        $product->update($productData);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    // Offer management
    public function storeOffer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url', // Validate as URL
        ]);

        $offerData = $request->all();

        // Store image URL directly
        $offerData['image'] = $request->input('image');

        Offer::create($offerData);

        return redirect()->back()->with('success', 'Offer added successfully.');
    }

    public function destroyOffer(Offer $offer)
    {
        $offer->delete();

        return redirect()->back()->with('success', 'Offer deleted successfully.');
    }
}
