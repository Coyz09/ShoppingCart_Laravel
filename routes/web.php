<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('shop.index');
});


Route::get('/', [
	'uses' => 'ProductController@getIndex',
	'as' => 'product.index'
]);

Route::get('/signup', [
       'uses' => 'UserController@getSignup',
       'as' => 'user.signup',
    ]);
Route::post('/signup', [
       'uses' => 'UserController@postSignup',
       'as' => 'user.signup',
    ]);
Route::get('profile', [
       'uses' => 'UserController@getProfile',
       'as' => 'user.profile',
    ]);

Route::get('signin', [
        'uses' => 'UserController@getSignin',
        'as' => 'user.signin',
       ]);

Route::post('signin', [
        'uses' => 'userController@postSignin',
        'as' => 'user.signin',
    ]);

Route::get('profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile',
          ]);

Route::get('logout', [
        'uses' => 'userController@getLogout',
        'as' => 'user.logout',
    ]);
    


Route::group(['prefix' => 'user'], function(){
    Route::group(['middleware' => 'guest'], function() {
        Route::get('signup', [
        'uses' => 'userController@getSignup',
        'as' => 'user.signup',
            ]);
        Route::post('signup', [
                'uses' => 'userController@postSignup',
                'as' => 'user.signup',
           ]);
        Route::get('signin', [
                'uses' => 'userController@getSignin',
                'as' => 'user.signin',
            ]);
        // Route::post('signin', [
        //         'uses' => 'userController@postSignin',
        //         'as' => 'user.signin',
        //  ]);
        Route::post('signin', [
                'uses' => 'LoginController@postSignin',
                'as' => 'user.signin',
         ]);
    });
    Route::group(['middleware' => 'auth'], function() {
     Route::get('profile', [
        'uses' => 'userController@getProfile',
        'as' => 'user.profile',
 ]);
   Route::get('logout', [
        'uses' => 'userController@getLogout',
        'as' => 'user.logout',
        ]);
    });

});


Route::get('add-to-cart/{id}',[
        'uses' => 'productController@getAddToCart',
        'as' => 'product.addToCart'
    ]);

Route::get('shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('checkout',[
        'uses' => 'productController@postCheckout',
        'as' => 'checkout',
        'middleware' =>'role:customer'
    ]);

Route::get('remove/{id}',[
        'uses'=>'productController@getRemoveItem',
        'as' => 'product.remove'
    ]);

Route::get('reduce/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

// Route::get('/dashboard',[
//     'uses' => 'DashboardController@index', 
//     'as' => 'dashboard.index'])->middleware('admin');

Route::get('dashboard',[
    'uses'=>'DashboardController@index',
    'as'=>'dashboard.index'])->middleware('role:admin');

Route::resource('item', 'ItemController',['middleware'=>'role:admin,encoder']);

Route::group(['middleware' => 'role:customer'], function() {
       Route::get('profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile',
     ]);
   });

Route::fallback(function(){
    return redirect()->back();
});

Route::group(['middleware' => 'role:admin,encoder'], function() {
    Route::post('import', 'ItemController@import')->name('item-import');

    Route::get('exportExcel',[
        'uses'=>'ItemController@exportExcel',
        'as' => 'item.exportExcel'
    ]);

     Route::get('exportPDF',[
        'uses'=>'ItemController@exportPDF',
        'as' => 'item.exportPDF'
    ]);

     Route::get('/get-item',[ 'uses'=>'ItemController@getItem','as' => 'item.getItem']);
  
    Route::resource('item', 'ItemController');
});

Route::post('search', [
         'uses' => 'SearchController@search',
         'as' => 'search',
     ]);

Route::get('customer/{id}', [
         'uses' => 'CustomerController@show',
         'as' => 'customer.show',
     ]);

