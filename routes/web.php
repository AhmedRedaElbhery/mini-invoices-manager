<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'auth/Login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::resource('/invoice',InvoiceController::class);
    Route::resource('/customers',CustomersController::class);
    Route::resource('/products',ProductsController::class);


});

require __DIR__.'/settings.php';