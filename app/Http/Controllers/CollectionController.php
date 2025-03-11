<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CollectionController extends Controller
{
    public function collection($type, $slug = '') {

        if ($type == 'all') {
            $products = Product::orderBy('id', 'desc')->paginate(8);
            return view('website.products.collection', compact('products'));
        }

        if ($type == 'products'){

            if($slug != ''){

                $product = Product::where('slug', $slug)->first();

                if(!empty($product)){
                    // dd($product);
                    return view('website.products.detail', compact('product'));
                }else{
                    $msg = 'Page Not Found';
                    return view('customErrors.404',compact('msg'));
                }

            }else{
                $products = Product::orderBy('id', 'desc')->paginate(8);
                return view('website.products.collection', compact('products'));
            }
        }
        
    }
}
