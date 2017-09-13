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

Route::post('register', 'ApiAuth\RegisterController@register');

Route::get('galleries', 'GalleryController@index');
Route::post('galleries', 'GalleryController@store');
Route::post('galleries/{id}', 'GalleryController@update');
Route::get('galleries/{id}', 'GalleryController@show');
Route::delete('galleries/{id}', 'GalleryController@destroy');

Route::post('comments', 'CommentController@store');
Route::delete('comments/{id}', 'CommentController@destroy');