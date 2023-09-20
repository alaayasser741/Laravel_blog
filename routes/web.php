<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\Website\ProfileController;
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
// Route::get('home', function () {
//     return "hello from website you are not admin";
// })->name('home');


// Route::group(['prefix' => 'user' ,'as' => 'user.'], function () {
//     Route::get('/', function () {
//         return "Hello form index";
//     })->name('index');
//     Route::get('/show', function () {
//         return "hello from users show";
//     })->name('show');
// });

// Route::get('post/index',[PostController::class,'index']);
// Route::get('post/show',[PostController::class,'show']);
Route::resource('posts', PostController::class);

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
