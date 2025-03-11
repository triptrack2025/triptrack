<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

use App\Models\ProductImage ;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','images')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'cancelled_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:24048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'product_category_id', 'price', 'cancelled_price', 'stock', 'description']);
        $data['is_best_seller'] = $request->has('is_best_seller') ? 1 : 0;
        $data['is_popular_product'] = $request->has('is_popular_product') ? 1 : 0;

        $product = Product::create($data);

        // Save multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/' . $imageName
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'cancelled_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:24048',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['name', 'product_category_id', 'price', 'cancelled_price', 'stock', 'description']);
        $data['is_best_seller'] = $request->has('is_best_seller') ? 1 : 0;
        $data['is_popular_product'] = $request->has('is_popular_product') ? 1 : 0;

        $product->update($data);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/' . $imageName
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    
    public function destroy(Product $product)
    {
        $product->delete(); // Soft delete instead of permanently deleting
    
        return redirect()->route('products.index')->with('success', 'Product moved to trash');
    }

    public function destroyImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete Image File from Storage
        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        }

        // Delete Image Record from Database
        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }
    
}


