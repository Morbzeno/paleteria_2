<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SupplyController;
use App\Models\Supply;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
// Route::get('/', function () {
//     return view('Admin_form');
// });

// Rutas de Clientes
Route::get('/clients/nuevo', [ClientController::class, 'create'])->name('client.create');

// Rutas de Admins (Resource ya incluye index, create, store, edit, update, destroy)
// Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('supply', SupplyController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('clients', ClientController::class);
    Route::GET('getImage/{filename}', [IngredientController::class, 'getImage']);
// });

Route::get('/', [IngredientController::class, 'carrousel'])->name('view.dashboard');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
