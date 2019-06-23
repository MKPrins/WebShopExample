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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::redirect('/', '/All');

Route::get('/All/{page?}/{limit?}', 'ProductController@getProducts');
Route::get('/Category/{category}/{page?}/{limit?}', 'ProductController@getProducts');
Route::get('/Product/{id}', 'ProductController@getProductInfo');
Route::post('/Search', 'ProductController@searchProducts');

Route::get('/ShoppingCartGet', 'ShoppingCartController@getShoppingCartInfo');
Route::post('/ShoppingCartAdd', 'ShoppingCartController@addProduct');
Route::post('/ShoppingCartUpdate', 'ShoppingCartController@updateAmount');
Route::post('/ShoppingCartRemove', 'ShoppingCartController@removeProduct');

Route::middleware('auth')->get('/Order', 'OrderController@getOrderForm');
Route::middleware('auth')->get('/PlaceOrder', 'OrderController@placeOrder');

Route::middleware('admin')->prefix('/Admin')->group(function() {

    Route::get('/Users', 'AdminController@getUsers');
    Route::get('/Orders', 'AdminController@getOrders');
    Route::get('/Products', 'AdminController@getProducts');

    Route::get('/ProductAdd', 'ProductController@getAddProductForm');
    Route::get('/ProductEdit/{id}', 'ProductController@getEditProductForm');
    Route::post('/ProductAdd', 'ProductController@addProduct');
    Route::get('/ProductDel/{id}', 'ProductController@deleteProduct');

    Route::get('/UserEdit/{id}', 'AdminController@getEditUserForm');
    Route::post('/UserEdit', 'AdminController@editUser');
    Route::get('/UserDel/{id}', 'AdminController@deleteUser');

});
