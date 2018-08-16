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
Route::post('register', 'API\RegisterController@register');
Route::post('token/refresh', 'API\RegisterController@refreshToken');

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('address/create', 'API\UserController@createAddress');
    Route::get('user/details', 'API\UserController@loadUserDetails');
    Route::post('user/update', 'API\UserController@updateUserData');
    Route::get('user/invoice', 'API\UserController@loadInvoice');
    Route::get('users/{id}/destroy', 'API\UserController@deleteUser');
    Route::post('users/metadata/destroy', 'API\UserController@deleteUserMeta');
    Route::get('/user', function (Request $request) {        return $request->user();    });
    Route::get('details', 'API\AuthController@userDetails');
});


Route::post('registernew', 'API\AuthController@userRegister');
Route::post('refreshtoken', 'API\AuthController@renewToken');
Route::post('partnerlogin', 'API\AuthController@partnerLogin');
Route::post('userlogin', 'API\AuthController@userLogin');

/*
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'API\AuthController@userDetails');
});*/