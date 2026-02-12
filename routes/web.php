<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('Admin_form');
});

// Rutas de Clientes
Route::get('/clients/nuevo', [ClientController::class, 'create'])->name('client.create');
Route::post('/client', [ClientController::class, 'store'])->name('clients.store');

// Rutas de Admins (Resource ya incluye index, create, store, edit, update, destroy)
Route::resource('admins', AdminController::class);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
