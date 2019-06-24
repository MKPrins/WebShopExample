<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{

    const SESSION_SHOPPING_CART = 'shopping_cart';

    public static function getShoppingCart() {
        $shoppingCart = session()->has(self::SESSION_SHOPPING_CART)
            ? session(self::SESSION_SHOPPING_CART)
            : json_encode([]);

        return json_decode($shoppingCart, true);
    }

    public static function addProduct(Request $request) {
        $id = $request->id;

        $shoppingCart = self::getShoppingCart();
        array_key_exists($id, $shoppingCart)
            ? $shoppingCart[$id] += 1
            : $shoppingCart[$id] = 1;

        session([self::SESSION_SHOPPING_CART => json_encode($shoppingCart)]);

        return response()->json($shoppingCart);
    }

    public static function updateAmount(Request $request) {
        $id = $request->id;
        $amount = (int)$request->amount;

        $shoppingCart = self::getShoppingCart();
        $shoppingCart[$id] = $amount;
        session([self::SESSION_SHOPPING_CART => json_encode($shoppingCart)]);
    }

    public static function removeProduct(Request $request) {
        $id = $request->id;

        $shoppingCart = self::getShoppingCart();
        unset($shoppingCart[$id]);
        session([self::SESSION_SHOPPING_CART => json_encode($shoppingCart)]);

        return response()->json($shoppingCart);
    }

    public static function emptyShoppingCart() {
        session([self::SESSION_SHOPPING_CART => json_encode([])]);
    }

    public static function getShoppingCartInfo($asObject = false) {
        $shoppingCart = self::getShoppingCart();

        $products = [];
        $totalPrice = 0;
        foreach($shoppingCart as $id => $amount) {
            $product = Product::with('image')->find($id);
            $product->amount = $amount;
            $product->thumb = isset($product->image->name) ? 'thumb-'.$product->image->name : 'default-product.png';
            $totalPrice += $product->price * $amount;

            unset($product->image);
            $products[] = $product;
        }

        $result = new \StdClass();
        $result->products = $products;
        $result->totalPrice = $totalPrice;

        return $asObject ? $result : response()->json($result);
    }

}
