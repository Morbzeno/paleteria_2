<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SupplyController;

Route::POST('/ingredient', [IngredientController::class, 'store']);
Route::GET('/ingredient', [IngredientController::class, 'index']);
Route::GET('/ingredient/{id}', [IngredientController::class, 'show']);
Route::PUT('/ingredient/{id}', [IngredientController::class, 'update']);
Route::DELETE('/ingredient/{id}', [IngredientController::class, 'destroy']);

// Route::Resource('supply', SupplyController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'index']);
Route::GET('/admin', [AdminController::class, 'index']);
Route::GET('/admin/{id}', [AdminController::class, 'show']);
Route::DELETE('/admin/{id}', [AdminController::class, 'destroy']);

Route::POST('/admin', [AdminController::class, 'store']);
Route::POST('/client', [ClientController::class, 'store']);
Route::PUT('/client/{id}', [ClientController::class, 'update']);
Route::GET('/client', [ClientController::class, 'index']);
Route::GET('/client/{id}', [ClientController::class, 'show']);
Route::PUT('/admin/{id}', [AdminController::class, 'update']);