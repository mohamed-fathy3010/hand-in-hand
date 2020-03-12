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

Route::get('/profile/{user}','profileController@index');
Route::get('/a',function (){
   $float=1.00;
   $int=1;
   if($float==$int)
       echo "yes";
   else
       echo "no";
});
