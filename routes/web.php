<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

// Pages
Route::get('', [IndexController::class, 'home'])->name('home');
Route::get('contract/{contract}', [IndexController::class, 'contract'])->name('contract');
Route::get('contracts/{category?}', [IndexController::class, 'contracts'])->name('contracts');
Route::view('contact-us', 'contactus')->name('connectus');
Route::post('contact-us', [ContactController::class, 'store'])->name('connect-us-save');
Route::view('about-us', 'aboutus')->name('aboutus');

// Login
Route::as('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLogin');
        Route::post('Login', [AuthController::class, 'login'])->name('login');
        Route::get('verify', [AuthController::class, 'showVerifyForm'])->name('showVerify');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
    });
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
});

// User
Route::group(['middleware' => 'auth'], function() {
    Route::get('contract/{contract}/buy', [IndexController::class, 'buy'])->name('buy');
    Route::get('payments', [IndexController::class, 'payments'])->name('payments');
    Route::get('payments_history', [IndexController::class, 'payments_history'])->name('payments_history');
    Route::any('transaction/{uuid}/back' , [IndexController::class,'callback'])->name('callback');
    Route::any('form/{uuid}', [IndexController::class, 'form'])->name('form');
    Route::post('form/{uuid}/confirmation', [IndexController::class, 'form_confirmation'])->name('form_confirmation');
    Route::any('generate/{uuid}', [IndexController::class, 'generate'])->name('generate');
});

// Dashboard
Route::redirect('admin', 'admin/dashboard');
Route::redirect('dashboard', 'admin/dashboard');
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::resource('category', CategoryController::class);
    Route::resource('contract', ContractController::class);
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('fillables', 'admin.fillables')->name('fillables');
    Route::post('fillables', [ContractController::class, 'fillables'])->name('fillables');
    Route::get('orders', [IndexController::class, 'orders'])->name('orders');
    Route::get('order/{uuid}/print', [IndexController::class, 'admin_print'])->name('print');
    Route::get('contact-us', [ContactController::class, 'index'])->name('connect-us-list');
    Route::get('contact-us/{contact}/delete', [ContactController::class, 'destroy'])->name('connect-us-delete');
});

