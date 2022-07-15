<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArchivistAuthController;


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

// Route::get('/dashboard',function () {
//     return view('dashboard/index');
// });

Route::get('archivist/login', [ArchivistAuthController::class, 'getLogin'])->name('archivist.login');
Route::post('archivist/login', [ArchivistAuthController::class, 'submitLogin']);

Route::group(['prefix' => 'archivist', 'middleware' => ['ArchivistAdmin']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/logout', [ArchivistAuthController::class, 'logout'])->name('logout');
    Route::resource('books/categories', 'App\Http\Controllers\BookCategoryController');
    Route::resource('books/tags', 'App\Http\Controllers\BookTagController');
    Route::resource('books', 'App\Http\Controllers\BookController');
    Route::get('/tag_get/{id}', [BookController::class, 'getTag'])->name('tag_get');
    // Route::get('/tag_select/{id}', [BookController::class, 'tagByCategory'])->name('tag_select');
});
