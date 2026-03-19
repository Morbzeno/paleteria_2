<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\AssetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::POST('resent_verification',[ ClientController::class, 'resent_verification'])->name('verification.resend');
Route::resource('clients', ClientController::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('supply', SupplyController::class);
    Route::resource('ingredients', IngredientController::class);
    
    Route::resource('assets', AssetController::class);
    Route::GET('getImage/{filename}', [IngredientController::class, 'getImage']);
    Route::GET('getVideo/{filename}', [IngredientController::class, 'getVideo']);
    Route::get('/generate-pdf', [SupplyController::class, 'generatePDF'])->name('supplies.generatePDF');
    Route::get('/generate-pdf-ingredients', [IngredientController::class, 'generatePDF'])->name('ingredients.generatePDF');
});

Route::get('/', function () {
    return view('dashboard');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
