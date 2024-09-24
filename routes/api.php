<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    // Invoices Routes
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::post('invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('invoices/update/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('invoices/delete/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // User Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

