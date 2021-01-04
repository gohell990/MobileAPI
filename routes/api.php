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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::middleware('api')->namespace('Auth')->prefix('auth')->group(function() {
//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');
    
// });
// // 

// Route::middleware('jwt.auth')->group(function() {
//     Route::apiResource('Users', 'UserController');
//     Route::get('usersSorting', 'UserController@orderById');
//     Route::get("orderby", "UserController@orderById");
    
//     Route::apiResource("Testing", "TestingController");
//     Route::get("orderById", "SortingController@orderById");
// });

// Route::controller("orderById", "SortingController@orderById");
// Route::get("orderById", function(){
//     return response()->json(["message"=>"helo world"]);
// });

// Route::get("admin", "UserController@index");

