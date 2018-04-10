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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function() {
    Route::post('register', 'RegisterController@register')->name('users.register');
    /** @todo make this as PATCH when FRONT will be ready. It's GET only for test right now. */
    Route::get('register/confirm', 'RegisterController@confirm')->name('users.register.confirm');
    Route::get('login', 'LoginController@login')->name('users.login');
});