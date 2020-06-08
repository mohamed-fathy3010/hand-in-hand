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


Route::get('/', 'HomeController@index');

Auth::routes(['verify'=> true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items','ItemController@index');
Route::get('/items/{item}','ItemController@show');

Route::get('/products','ProductController@index');
Route::get('/product/{product}','ProductController@show');

Route::get('/events','EventController@index');
Route::get('/event/{event}','EventController@show');

Route::get('/services','ServiceController@index');
Route::get('/service/{service}','ServiceController@show');



Route::get('/profile/{user}','profileController@index');
Route::get('/a',function (){
\App\Events\Test::dispatch('hmada');
});
Route::get('/welcome',function ()
{
   return view('welcome');
});
