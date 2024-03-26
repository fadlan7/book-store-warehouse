<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function(){
    Route::get('dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::controller(BookController::class)->prefix('books')->group(function(){
        Route::get('', 'index')->name('books');
        Route::get('create', 'create')->name('books.create');
        Route::post('store', 'store')->name('books.store');
        Route::get('edit/{id}', 'edit')->name('books.edit');
        Route::put('edit/{id}', 'update')->name('books.update');
    });

});