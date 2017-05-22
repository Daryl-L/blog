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

Route::middleware('auth.basic.once')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article', 'Api\ArticleController@index');

Route::post('/article', 'Api\ArticleController@store');

Route::patch('/article/{id}', 'Api\ArticleController@publish')->where('id', '[0-9]+');

Route::delete('/article/{id}', 'Api\ArticleController@destroy')->where('id', '[0-9]+');

Route::get('/category', 'Api\CategoryController@index');
