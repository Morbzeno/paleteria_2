<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'index']);
Route::GET('/admin', [AdminController::class, 'index']);
Route::GET('/admin/{id}', [AdminController::class, 'show']);
Route::POST('/admin', [AdminController::class, 'store']);
Route::PUT('/admin/{id}', [AdminController::class, 'update']);