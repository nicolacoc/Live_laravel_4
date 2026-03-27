<?php

use App\Http\Controllers\Actor_controller;
use App\Http\Controllers\Category_controller;
use App\Http\Controllers\Film_controller;
use App\Http\Controllers\ProfileController;
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
})->name('Home_Page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(Film_controller::class)->prefix('/films_admin')->group(function () {
        Route::get('/', 'Index_admin')->name('films_admin.index');
        Route::get('/edit/{id}', 'show_edit')->name('films_admin.edit');
        Route::delete('/del/{id}', 'delete')->name('films_admin.delete');
        Route::get('/insert', 'show_create')->name('films_admin.edit.insert');
        Route::post('/insert', 'insert')->name('films_admin.insert');
        Route::post('/edit/upd/{id}', 'update')->name('films_admin.update');
    });
    Route::controller(Category_controller::class)->prefix('/films_category')->group(function () {
        Route::get('/','Index_admin')->name('films_category.index');
        Route::get('/edit/{id}','show_edit')->name('films_category.edit');
        Route::delete('/del/{id}','delete')->name('films_category.delete');
        Route::get('/insert','show_create')->name('films_category.edit.insert');
        Route::post('/insert','insert')->name('films_category.insert');
        Route::post('/edit/upd/{id}','update')->name('films_category.update');
    });
    Route::controller(Actor_controller::class)->prefix('/films_actor')->group(function () {
        Route::get('/','index_admin')->name('films_actor.index');
        Route::get('/edit/{id}','show_edit')->name('films_actor.edit');
        Route::delete('/del/{id}','delete')->name('films_actor.delete');
        Route::get('/insert','show_create')->name('films_actor.edit.insert');
        Route::post('/insert','insert')->name('films_actor.insert');
        Route::post('/edit/upd/{id}','update')->name('films_actor.update');
    });
});

Route::get('/actor', [Film_controller::class, 'index'])->name('film.index');
Route::get('/actor/{id}', [Film_controller::class, 'film_detail'])->name('film.detail');

require __DIR__.'/auth.php';
