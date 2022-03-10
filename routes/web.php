<?php

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
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

// function remember($key, $second, $callback)
// {
//     if ($value = Redis::get($key)) {
//         return json_decode($value);
//     }

//     $value = Article::all();

//     Redis::setex($key, $second, $value = $callback());

//     return $value;
// }

Route::get('/', function () {
    // return remember('article.all', 60 * 60, function () {
    //     return Article::all();
    // });

    return Cache::remember('article.all', 60 * 60, function () {
        // dd('query');
        return Article::all();
    });
});