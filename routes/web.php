<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArchivistAuthController;
use App\Http\Controllers\HomeController;


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/vook/{id}', [HomeController::class, 'show'])->name('vook.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/request/vook', [HomeController::class, 'request'])->name('request.book');
Route::resource('request/book', 'App\Http\Controllers\RequestBookController');

// admin auth
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
