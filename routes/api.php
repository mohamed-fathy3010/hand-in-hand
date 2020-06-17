<?php

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
//Route::post('password/email','ForgotPasswordcontroller@sendResetLinkEmail');
//Route::post('password/reset','ForgotPasswordcontroller@reset');

Route::group([
    'prefix' => 'password',
], function () {
    Route::post('email', 'ResetPasswordController@create');
    Route::get('reset/{token}/{email}',  'ResetPasswordController@find');
    Route::post('reset', 'ResetPasswordController@reset');
});

Route::middleware('auth:api')->group(function () {
    Route::get('profile', 'PassportController@details');
    Route::patch('profile/update','PassportController@updateProfile');

    Route::post('items','ItemController@create');
    Route::post('items/{item}/report','ItemController@report');
    Route::post('items/{item}/request','ItemController@request');
    Route::patch('items/{item}','ItemController@update');
    Route::patch('items/{item}/cancel','ItemController@cancel');
    Route::delete('items/{item}','ItemController@destroy');
    Route::get('items','ItemController@index');
    Route::get('items/{item}','ItemController@show');

    Route::post('products','ProductController@create');
    Route::get('products','ProductController@index');
    Route::post('products/{product}/report','ProductController@report');
    Route::post('products/{product}/request','ProductController@request');
    Route::patch('products/{product}','ProductController@update');
    Route::delete('products/{product}','ProductController@destroy');

    Route::post('events','EventController@create')->middleware('trusted');
    Route::post('events/{event}/report','EventController@report');
    Route::post('events/{event}/interest','EventController@interest');
    Route::patch('events/{event}','EventController@update');
    Route::delete('events/{event}','EventController@destroy');
    Route::get('events/{event}/interests','EventController@interesters');

    Route::post('services','ServiceController@create');
    Route::post('services/{service}/report','ServiceController@report');
    Route::post('services/{service}/interest','ServiceController@interest');
    Route::patch('services/{service}','ServiceController@update');
    Route::delete('services/{service}','ServiceController@destroy');
    Route::get('services/{service}/interests','ServiceController@interesters');

  Route::patch('deals/{deal}/accept','DealController@accept');
  Route::patch('deals/{deal}/decline','DealController@decline');
  Route::patch('deals/{deal}/respond','DealController@respond');
  Route::get('deals/{deal}','DealController@show');
  Route::get('deals','DealController@index');


  Route::get('notifications','NotificationController@index');
  Route::get('notifications/{notification}','NotificationController@show');

    Route::get('events/{event}','EventController@show');
    Route::get('events','EventController@index');
    Route::get('services','ServiceController@index');
    Route::get('services/{service}','ServiceController@show');

    Route::get('/a',function (){
        $type = 'items';
        return response()->json(auth()->user());
    });
    Route::post('/validations','ValidationController@store');
});

Route::get('email/verify/{id}', 'VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'VerificationController@resend')->name('verificationapi.resend');




