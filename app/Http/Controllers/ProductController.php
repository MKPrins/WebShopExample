<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function getProducts($limit = 0, $offset = 0, $category = 0) {
        $products = Product::where('category', '=', $category)->take($limit)->offset($offset)->get();

        return view('partials.products')->with('Products', $products);
    }

}
