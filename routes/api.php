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

Route::get('/books', 'BooksController@getCollection');
Route::group(['middleware' => ['auth.admin']], function () {
    Route::post('/books', 'BooksController@post');
});
Route::group(['middleware' => ['auth']], function () {
    Route::post('/books/{book}/reviews', 'BooksController@postReview');
});