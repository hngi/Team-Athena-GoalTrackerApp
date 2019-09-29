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


Route::post('/register', 'AuthController@register');
Route::post('/activate', 'AuthController@activate');
Route::post('/login', 'AuthController@login');
Route::post('/reset', 'AuthController@reset');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['as' => '', 'middleware' => ['auth']], function () {
    Route::get('/goals', 'GoalController@goals');
    Route::post('/goal/add', 'GoalController@add');
    Route::post('/goal/remove', 'GoalController@remove');

    Route::post('/todo/add', 'TodoController@add');
    Route::post('/todo/done', 'TodoController@complete');
    Route::post('/todo/remove', 'TodoController@remove');

    Route::get('/statistics', 'GoalController@statistics');
// });

// Route::post('goal/create', 'GoalController@test');
