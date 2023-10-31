<?php

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
// test rout
Route::get('hi',  function (Request $request) {
    return "Hiee";
});
//  authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile');
    Route::delete('/account', [App\Http\Controllers\UserController::class, 'deleteAccount'])->name('delete');

    
    Route::get('/menu', [App\Http\Controllers\MenuController::class, 'getAllItems'])->name('menu');
    Route::get('/menu/{id}', [App\Http\Controllers\MenuController::class, 'getItemById'])->name('getItemById');
    Route::post('/menu', [App\Http\Controllers\MenuController::class, 'addItem'])->name('menu');
});


Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/reset', [App\Http\Controllers\AuthController::class, 'reset'])->name('reset');
