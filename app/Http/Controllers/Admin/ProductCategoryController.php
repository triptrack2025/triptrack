<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;


class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::OrderBy('id','desc')->paginate(5);
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25|unique:product_categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'slug']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
            $data['image'] = 'uploads/category/'.$imageName;
        }
        
        ProductCategory::create($data);

        return redirect()->route('product-categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category =  ProductCategory::find($id);
        return view('admin.product-categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255|unique:product_categories,name,' . $request->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = ProductCategory::find($request->id);
        $data = [];
        $data['name'] = $request->name;

        // Check if new image is uploaded
        if ($request->hasFile('image')) {
            // ✅ Delete Old Image from public/uploads if Exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image)); // Delete old image
            }

            // Upload New Image to public/uploads/category
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Unique Image Name
            $image->move(public_path('uploads/category'), $imageName);
            $data['image'] = 'uploads/category/'.$imageName;
        }

        $category->update($data);

        return redirect()->route('product-categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $product_category)
    {
        if ($product_category->image && file_exists(public_path($product_category->image))) {
            unlink(public_path($product_category->image)); // Delete old image
        }
        $product_category->delete();
        return redirect()->route('product-categories.index')->with('success', 'Category deleted successfully');
    }
    

}
