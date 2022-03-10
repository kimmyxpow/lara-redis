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

// Menyimpan Dan Menampilkan Nilai Redis Di Laravel

// Route::get('/', function () {
//     // Redis::set('world', 'hello');
//     // return Redis::get('world');
//     return view('welcome');
// });

Route::get('/articles/{id}', function ($id) {
    $views = Redis::get("article.{$id}.views");
    return "Article dengan id {$id} memiliki {$views} viewer";
});

Route::get('/articles/{id}/visit', function ($id) {
    Redis::incr("article.{$id}.views");
    return redirect()->back();
});

// End Menyimpan Dan Menampilkan Nilai Redis Di Laravel

// Implementasi Sorted Sets Di Laravel

Route::get('/topic/{topic}', function ($topic) {
    return $topic;
});

Route::get('/topic/{topic}/visit', function ($topic) {
    Redis::zincrby('trending', 1, $topic);
    Redis::zremrangebyrank('trending', 0, -4);
    return redirect()->back();
});

Route::get('/trending', function () {
    $trending = Redis::zrevrange('trending', 0, -1);
    return $trending;
});

// End Implementasi Sorted Sets Di Laravel

// Menggunakan Tipe Hashes Di Laravel

Route::get('/', function () {
    $user1stat = [
        'bookmark' => 10,
        'watched' => 50,
        'lessons' => 15
    ];

    Redis::hmset('user.1.stat', $user1stat);

    return $user1stat;

    // return view('welcome');
});

Route::get('/user/{id}/stat', function ($id) {
    $user = Redis::hgetall("user.{$id}.stat");
    return $user;
});

// End Menggunakan Tipe Hashes Di Laravel
