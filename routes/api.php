<?php

use Illuminate\Http\Request;
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
    Route::post('profile/update','PassportController@updateProfile');
});

Route::get('email/verify/{id}', 'VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'VerificationController@resend')->name('verificationapi.resend');
