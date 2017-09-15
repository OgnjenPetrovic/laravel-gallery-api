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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'ApiAuth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@authenticate');

Route::middleware('jwt')->get('/galleries/auth-user', 'UserGalleryController@loggedUser');
Route::middleware('jwt')->get('/galleries', 'GalleryController@index');
Route::middleware('jwt')->post('/galleries', 'GalleryController@store');
Route::middleware('jwt')->post('/galleries/{id}', 'GalleryController@update');
Route::middleware('jwt')->get('/galleries/{id}', 'GalleryController@show');
Route::middleware('jwt')->delete('/galleries/{id}', 'GalleryController@destroy');
Route::middleware('jwt')->get('/galleries/author/{id}', 'UserGalleryController@index');
Route::middleware('jwt')->post('/comments', 'CommentController@store');
Route::middleware('jwt')->delete('/comments/{id}', 'CommentController@destroy');
