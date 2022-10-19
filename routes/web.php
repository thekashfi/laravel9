<?php

use AndreasElia\Analytics\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\PaymentController;
use App\Http\Controllers\Profile\ContractController as PContractController;
use Illuminate\Support\Facades\Route;

// Pages
Route::middleware('analytics')->group(function () {
    Route::get('', [IndexController::class, 'home'])->name('home');
    Route::get('contract/{contract}', [IndexController::class, 'contract'])->name('contract');
    Route::get('contracts/{category?}', [IndexController::class, 'contracts'])->name('contracts');
    Route::view('contact-us', 'contactus')->name('connectus');
    Route::post('contact-us', [ContactController::class, 'store'])->name('connect-us-save');
    Route::view('about-us', 'aboutus')->name('aboutus');
    Route::any('transaction/{uuid}/back' , [PaymentController::class,'callback'])->name('callback');
});

// Login
Route::as('auth.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLogin');
        Route::post('Login', [AuthController::class, 'login'])->name('login');
        Route::get('verify', [AuthController::class, 'showVerifyForm'])->name('showVerify');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
    });
    Route::any('logout', [AuthController::class, 'logout'])->name('logout');
});

// User
Route::group(['middleware' => ['auth']], function() {
    Route::get('buy/contract/{contract}', [PaymentController::class, 'buyContract'])->name('buy');
    Route::get('bought/items', [ProfileController::class, 'boughtItem'])->name('payments');
    Route::get('orders', [ProfileController::class, 'orders'])->name('payments_history');
    Route::any('form/{uuid}/{id}', [PContractController::class, 'form'])->name('form');
    Route::post('form/{uuid}/confirmation', [PContractController::class, 'form_confirmation'])->name('form_confirmation');
    Route::any('generate/{uuid}', [PContractController::class, 'generate'])->name('generate');
});

// Dashboard
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::redirect('admin', 'admin/dashboard');
    Route::redirect('dashboard', 'admin/dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('contract', ContractController::class);
    Route::resource('file', FileController::class);
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::view('fillables', 'admin.fillables')->name('fillables');
    Route::post('fillables', [ContractController::class, 'fillables'])->name('fillables');
    Route::get('orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('order/{uuid}/print', [AdminController::class, 'admin_print'])->name('print');
    Route::get('order/{uuid}', [AdminController::class, 'order'])->name('order');
    Route::get('contact-us', [ContactController::class, 'index'])->name('connect-us-list');
    Route::get('contact-us/{contact}/delete', [ContactController::class, 'destroy'])->name('connect-us-delete');
});

