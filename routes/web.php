<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'auth/Login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/invoice',InvoicesController::class);
    Route::resource('/customers',CustomersController::class);
    Route::resource('/products',ProductsController::class);

    Route::get('/invoicedetails/{id}',[InvoicesDetailsController::class , 'addItem']);
    Route::post('/invoicedetails',[InvoicesDetailsController::class , 'storeItem']);
    Route::delete('/invoiceItem/{id}',[InvoicesController::class , 'destroyItem']);
    Route::post('/invoiceAddItem/{id}',[InvoicesController::class , 'addItem']);
    Route::post('/invoicemakepaid/{id}',[InvoicesController::class , 'makePaid']);
    Route::get('/invoiceeditItem/{id}',[InvoicesController::class , 'editItem']);
    Route::post('/invoiceupdateItem/{id}',[InvoicesController::class , 'updateItem']);

    Route::get('/invoicepay/{id}',[PaymentsController::class , 'getpay']);
    Route::post('/invoicepay/{id}',[PaymentsController::class , 'pay']);


});

require __DIR__.'/settings.php';