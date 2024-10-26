<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageStocksController;
use App\Http\Controllers\ManageSaleEntryController;

Route::get('/', function () {
    return view('layouts.partials.login');
});

Auth::routes();

// Update the dashboard route to use the LanguageController's index method
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/manageStocks', [ManageStocksController::class, 'manageStocks'])->name('manageStocks');
Route::get('/getBookDetails', [ManageStocksController::class, 'getBookDetails'])->name('getBookDetails');
Route::get('/manageSaleEntry', [ManageSaleEntryController::class, 'manageSaleEntry'])->name('manageSaleEntry');

// Login route
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/books', [DashboardController::class, 'getBooks'])->name('books.data');

Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');