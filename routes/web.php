<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('Admin_form');
});

Route::get('/administradores/nuevo', function(){
    return view('Admin_form');
})->name('admins.create');

Route::get('/clients/nuevo', function(){
    return view('clients/Client_form');
})->name('client.create');

Route::POST('/client', [ClientController::class, 'store'])->name('clients.store');

Route::POST('/admin', [AdminController::class, 'store'])->name('admins.store');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
