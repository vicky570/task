<?php

use Illuminate\Support\Facades\Route;
use App\Models\product;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/product', function () {
    $product = product::all();
    echo '<pre>';
    print_r($product->toArray());
});

Route::get('products','productController@productList')->name('products');

// Admin 
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        // login route
        Route::get('login','AuthenticatedSessionController@create')->name('login');
        Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function(){
        Route::get('dashboard','HomeController@index')->name('dashboard');

        Route::get('admin-test','HomeController@adminTest')->name('admintest');
        Route::get('editor-test','HomeController@editorTest')->name('editortest');
        Route::get('products','HomeController@productList')->name('productList');
        Route::get('user','HomeController@userList')->name('userList');
        Route::get('addUser','HomeController@addUser')->name('addUser');
        Route::post('createUser','HomeController@createUser')->name('createUser');
        Route::get('userEdit/{id}','HomeController@userEdit')->name('userEdit');
        Route::post('updateUser/{id}','HomeController@updateUser')->name('updateUser');
        Route::get('userDelete/{id}','HomeController@userDelete')->name('userDelete');
        Route::get('addProduct','HomeController@addProduct')->name('addProduct');
        Route::post('createProduct','HomeController@createProduct')->name('createProduct');
        Route::get('productEdit/{id}','HomeController@productEdit')->name('productEdit');
        Route::post('updateProduct/{id}','HomeController@updateProduct')->name('updateProduct');
        Route::get('productDelete/{id}','HomeController@productDelete')->name('productDelete');

        Route::resource('posts','PostController');

    });
    Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
});






