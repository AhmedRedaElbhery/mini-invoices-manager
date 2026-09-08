<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'auth/Login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::resource('/invoice',InvoicesController::class);
    Route::resource('/customers',CustomersController::class);
    Route::resource('/products',ProductsController::class);

    Route::get('/invoicedetails/{id}',[InvoicesDetailsController::class , 'addItem']);
    Route::post('/invoicedetails',[InvoicesDetailsController::class , 'storeItem']);


});

require __DIR__.'/settings.php';