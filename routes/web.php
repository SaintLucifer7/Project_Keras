<?php

use Illuminate\Support\Facades\Route;
use App\Exports\CartExport;

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
    //return view('welcome');
    return view('login');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/account', function () {
    return view('account');
});

Route::get('/home', 'UserController@index');
Route::get('/login', 'UserController@login')->name('login');
Route::post('/loginPost', 'UserController@loginPost');
Route::get('/register', 'UserController@register');
Route::post('/registerPost', 'UserController@registerPost');
Route::get('/logout', 'UserController@logout');
Route::get('/account', 'UserController@account')->name('account');
Route::get('destroy/{id}','UserController@destroy');
Route::resource('user', 'UserController'); 
Route::get('/myprofile','UserController@myprofile');
Route::any('/updateprofile','UserController@updateprofile');
Route::any('/update','UserController@update');    
Route::any('/changepassword','UserController@changepass');    
Route::any('/updatepass','UserController@updatepass');



Route::resource('product', 'ProductController');

Route::get('stock-list','PagesController@stockList');
Route::get('cart-list','PagesController@cartList');
Route::get('add-stock','PagesController@addStock');
Route::get('dashboard','PagesController@dashboard');
Route::get('history','PagesController@history');

Route::get('/search','ProductController@search')->name('search');
Route::get('cutStock/{id}', 'CartController@cutStock');
Route::resource('cart', 'CartController');
Route::get('/download', function(){
    return Excel::download(new CartExport, 'Invoice.xlsx');
});
Route::get('/flush', 'ProductController@flush');

Route::get('/import_excel', 'ImportExcelController@index');
Route::post('/import_excel/import', 'ImportExcelController@import');
