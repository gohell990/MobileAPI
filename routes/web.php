<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
  
// Route::get('/upload', 'ImageController@index');

// Route::post("/upload", 'ImageController@store')->name('add');

// Route::get("/uploadpage", "ImageController@orderImage");

// // Route::post("/upload", "ImageController@login")->name("login");

// Route::get("test", "TestController@index");
// Route::post("test", "TestController@logging")->name("login");
// Route::post("test", "TestController@me")->name("me");