<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->prefix('users')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::get('profile', 'show')->middleware('auth:api');
    Route::put('update_profile/{user}', 'updateProfile')->middleware('auth:api');
});

/////////////////////////////////book routes\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
Route::controller(BookController::class)->prefix('books')->group(function () {
    Route::get('all', 'index');
    Route::get('show/{book}', 'show');
    Route::post('store', 'store')->middleware('admin');
    Route::put('update/{book}', 'update')->middleware('admin');
    Route::delete('delete/{book}', 'destroy')->middleware('admin');
});

/////////////////////////////////authors routes\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
Route::controller(AuthorController::class)->prefix('authors')->group(function () {
    Route::get('all', 'index');
    Route::get('show/{author}', 'show');
    Route::post('store', 'store')->middleware('admin');
    Route::put('update/{author}', 'update')->middleware('admin');
    Route::delete('delete/{author}', 'destroy')->middleware('admin');
});


