<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users','UsersController@index')->name('users.index');
Route::post('/login', 'LoginController@login')->name('user.login');

Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/feed', 'PostsController@index')->name('feed.index');

    Route::post('/mute/{user}','UserMuteController@mute')->name('user.mute');
    Route::post('/unmute/{user}','UserMuteController@unmute')->name('user.unmute');

    Route::get('/users/muted','UsersController@muted')->name('users.muted');
});
