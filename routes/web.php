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
use \Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index');

Auth::routes(['verify'=> true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items','ItemController@index');
Route::get('/items/{item}','ItemController@show');
;


Route::get('/products','ProductController@index');
Route::get('/products/{product}','ProductController@show');



Route::get('/events','EventController@index');
Route::get('/events/{event}','EventController@show');



Route::get('/services','ServiceController@index');
Route::get('/services/{service}','ServiceController@show');



Route::middleware('auth')->group(function () {
    Route::get('/profile','profileController@index');
    Route::get('/profile/edit','profileController@edit');
    Route::patch('/profile/update','profileController@update');

    Route::post('/items','ItemController@store');
    Route::delete('/items/{item}','ItemController@destroy');
    Route::patch('/items/{item}','ItemController@update');
    Route::post('items/{item}/report','ItemController@report');
    Route::post('items/{item}/request','ItemController@request');

    Route::post('/products','ProductController@store');
    Route::delete('/products/{product}','ProductController@destroy');
    Route::patch('/products/{product}','ProductController@update');
    Route::post('products/{product}/report','ProductController@report');
    Route::post('products/{product}/request','ProductController@request');

    Route::post('/events','EventController@store')->middleware('trusted');
    Route::delete('/events/{event}','EventController@destroy');
    Route::patch('/events/{event}','EventController@update');
    Route::post('events/{event}/report','EventController@report');
    Route::post('events/{event}/interest','EventController@interest');

    Route::post('/services','ServiceController@store');
    Route::delete('/services/{service}','ServiceController@destroy');
    Route::patch('/services/{service}','ServiceController@update');
    Route::post('services/{service}/report','ServiceController@report');
    Route::post('services/{service}/interest','ServiceController@interest');
});

Route::get('/a',function (){
\App\Events\Test::dispatch('hmada');
});
Route::get('/welcome',function ()
{
   return view('welcome');
});
