<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Image;

use Intervention\Image\ImageManagerStatic;

dd(extension_loaded('gd'));

class ProductController extends Controller
{

    public function getProducts($category = 0, $page = 0, $limit = 25) {
        $products = Product::with('image', 'category')
            ->when($category, function($query, $category) {
                $query->where('category_id', '=', $category);
            })->take($limit)->offset($limit * $page)->get();

        return view('partials.products')->with('Products', $products);
    }

    public function getProductInfo($id) {
        $product = Product::with('image')->find($id);

        return view('partials.product_info')->with('Product', $product);
    }

    public function getAddProductForm() {
        return view('partials.admin.add_product');
    }

    public function getEditProductForm($id) {
        $product = Product::with('image')->find($id);

        return view('partials.admin.add_product')->with('Product', $product);
    }

    public function addProduct(Request $request) {
        $product = $request->id ? Product::with('image')->find($request->id) : new Product();
        $product->title = $request->title;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;

        $imageFile = $request->file('image');
        if($imageFile){
            if($request->id) {
                $product->image && Storage::delete('public/images/' . $product->image->name);
            }

            $filename = time() . urlencode($request->title) . "." . $imageFile->getClientOriginalExtension();
            Storage::putFileAs('public\images', $imageFile, $filename);

            $image = $product->image ? Image::find($product->image->id) : new Image();
            $image->name = $filename;
            $image->save();

            $product->image_id = $image->id;
        }

        $product->save();

        return redirect('/Admin/Products');
    }

    public function deleteProduct($id) {
        $product = Product::with('image')->find($id);
        $product->image && Storage::delete('public/images/' . $product->image->name);
        $product->delete();

        return redirect('/Admin/Products');
    }

    public function searchProducts(Request $request) {
        $search_query = $request->search_query;
        $products = Product::with('image')
            ->where('title', 'like', '%'.$search_query.'%')
            ->get();
        return view('partials.products')->with('Products', $products);
    }

}
