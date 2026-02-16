<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

Route::resource('admins', AdminController::class);

// Route::get('/', function () {
//     return view('Admin_form');
// });

// Rutas de Clientes
Route::get('/clients/nuevo', [ClientController::class, 'create'])->name('client.create');


// Rutas de Admins (Resource ya incluye index, create, store, edit, update, destroy)

Route::resource('clients', ClientController::class);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
