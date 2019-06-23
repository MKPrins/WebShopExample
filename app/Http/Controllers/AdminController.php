<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function getUsers() {
        $users = User::all();

        return view('partials.admin.users')->with('Users', $users);
    }

    public function getOrders() {
        $orders = Order::with('user')->get();

        return view('partials.admin.orders')->with('Orders', $orders);
    }

    public function getProducts() {
        $products = Product::with('image', 'category')->get();

        return view('partials.admin.products')->with('Products', $products);
    }

    public function getEditUserForm($id) {
        $user = User::find($id);

        return view('auth.edit')->with('User', $user);
    }

    public function editUser(Request $request) {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->streetname = $request->streetname;
        $user->housenumber = $request->housenumber;
        $user->zipcode = $request->zipcode;
        $user->region = $request->region;
        $user->save();

        return redirect('/Admin/Users');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/Admin/Users');
    }

}
