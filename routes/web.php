<?php

use App\Http\Controllers\category_controller;
use App\Http\Controllers\file_controller;
use App\Http\Controllers\film_controller;
use App\Http\Controllers\users_controller;
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

Route::get('/film', [film_controller::class, 'index']);
Route::get('/actor/{id}', [film_controller::class, 'prova']);
Route::get('/category/{id}', [category_controller::class, 'index']);
Route::post('/film/update/{id}', [film_controller::class, 'update']);
Route::post('/film/insert', [film_controller::class, 'insert']);
Route::delete('/film/delete/{id}', [film_controller::class, 'delete']);

Route::post('/file/{id}/', [file_controller::class, 'index']);
