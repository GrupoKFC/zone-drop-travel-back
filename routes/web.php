<?php

use Illuminate\Support\Facades\Route;

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


Route::view("/app/{path?}", "welcome");

Route::get('/tables', function () {
    return view('welcome');
});


Route::get('/reportes', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('welcome');
});


Route::get('/authentication/sign-up', function () {
    return view('welcome');
});


Route::get('/tables/public/static/css/', function () {
    return view('welcome');
});
