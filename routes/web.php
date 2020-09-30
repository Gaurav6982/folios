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

Auth::routes();
Route::group(['prefix'=>'user'],function(){
    Route::post('login','NAuthContro@logina');
    Route::post('register','NAuthContro@registera');
});
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('submit','UserAllController@submit');
    Route::get('edit','UserAllController@edit');
    Route::post('/user/edit','UserAllController@edit_user');
    Route::get('final','UserAllController@final');
    Route::get('details','UserAllController@details');
});
Route::get('/token','NAuthContro@token');
Route::get('get-slug','UserAllController@getslug');
Route::get('/portfolio/{slug}','UserAllController@share');
Route::get('/details/portfolio/{slug}','UserAllController@share_details');