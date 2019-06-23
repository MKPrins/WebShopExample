<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function getOrderForm() {
        $shoppingCart = ShoppingCartController::getShoppingCartInfo(true);

        return view('partials.order')->with('ShoppingCart', $shoppingCart);
    }

    public function placeOrder() {
        $shoppingCart = ShoppingCartController::getShoppingCartInfo(true);

        $order = new Order();
        $order->user_id = \Auth::user()->id;
        $order->address = \Auth::user()->getFullAddress();
        $order->products = json_encode($shoppingCart->products);
        $order->price = $shoppingCart->totalPrice;
        $order->save();

        ShoppingCartController::emptyShoppingCart();

        return view('partials.order_complete');
    }

}
