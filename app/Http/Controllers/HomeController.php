<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class HomeController extends Controller
{

    public function dashboard()
    {
        $bestSellers = Product::with('images')->where('is_best_seller', 1)->OrderBy('id','desc')->limit(4)->get(); // Fetch only 4 Best Sellers
        $populerProducts = Product::with('images')->where('is_popular_product', 1)->OrderBy('id','desc')->limit(8)->get();
        return view('website.index', compact('bestSellers','populerProducts'));
    }

    
}
