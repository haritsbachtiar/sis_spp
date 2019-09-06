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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'SqlController@login');
Route::post('/login', 'SqlController@loginHandler');
Route::get('/logout', 'SqlController@logout');

Route::group(['middleware'=>['login']],function (){
    Route::post('set/konfirmasi', 'DatabaseController@konfirmasi');
    Route::post('/specific', 'SqlController@getUsers');
    Route::get('/set/users', 'SqlController@setUsers');
    Route::get('/get/price/{id}', 'SqlController@getPrice');
    Route::post('/set/prices', 'SqlController@setPrices');
    Route::get('/get/storage', 'DatabaseController@getImage');
    Route::get('/data', 'DatabaseController@index');
    Route::get('/set/user', 'DatabaseController@setUser');
    Route::get('/get/biodata', 'DatabaseController@getBiodata');
    Route::post('/set/biodata', 'DatabaseController@setBiodata');
    Route::post('/set/tagihan', 'DatabaseController@setTagihan');
    Route::post('/get/payment', 'DatabaseController@getPayment');
    Route::get('/home', 'SqlController@getFilter');
});