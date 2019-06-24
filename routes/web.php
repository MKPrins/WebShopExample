<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::redirect('', 'All');

Route::get('All/{page?}/{limit?}', 'ProductController@getProducts')->name('all_products');
Route::get('Category/{category}/{page?}/{limit?}', 'ProductController@getProducts')->name('category');
Route::get('Product/{id}', 'ProductController@getProductInfo')->name('product');
Route::post('Search', 'ProductController@searchProducts')->name('search_product');

Route::get('ShoppingCartGet', 'ShoppingCartController@getShoppingCartInfo');
Route::post('ShoppingCartAdd', 'ShoppingCartController@addProduct');
Route::post('ShoppingCartUpdate', 'ShoppingCartController@updateAmount');
Route::post('ShoppingCartRemove', 'ShoppingCartController@removeProduct');

Route::middleware('auth')->get('Order', 'OrderController@getOrderForm')->name('order');
Route::middleware('auth')->get('PlaceOrder', 'OrderController@placeOrder')->name('place_order');

Route::middleware('admin')->prefix('Admin')->group(function() {

    Route::get('Users', 'AdminController@getUsers')->name('admin_users');
    Route::get('Orders', 'AdminController@getOrders')->name('admin_orders');
    Route::get('Products', 'AdminController@getProducts')->name('admin_products');

    Route::get('ProductAdd', 'ProductController@getAddProductForm')->name('product_add');
    Route::get('ProductEdit/{id}', 'ProductController@getEditProductForm')->name('product_edit');
    Route::post('ProductAdd', 'ProductController@addProduct')->name('product_add_post');
    Route::get('ProductDel/{id}', 'ProductController@deleteProduct')->name('product_del');

    Route::get('UserEdit/{id}', 'AdminController@getEditUserForm')->name('user_edit');
    Route::post('UserEdit', 'AdminController@editUser')->name('user_edit_post');
    Route::get('UserDel/{id}', 'AdminController@deleteUser')->name('user_del');

});
