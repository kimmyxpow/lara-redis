<?php

use Illuminate\Support\Facades\Redis;
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
    // Redis::set('world', 'hello');
    // return Redis::get('world');
    return view('welcome');
});

Route::get('/articles/{id}', function ($id) {
    $views = Redis::get("article.{$id}.views");
    return "Article dengan id {$id} memiliki {$views} viewer";
});

Route::get('/articles/{id}/visit', function ($id) {
    Redis::incr("article.{$id}.views");
    return redirect()->back();
});