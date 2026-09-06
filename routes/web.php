<?php

use App\Http\Controllers\CustomersController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'auth/Login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');


    Route::resource('/customers',CustomersController::class);


});

require __DIR__.'/settings.php';