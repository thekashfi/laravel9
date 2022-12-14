<?php

use AndreasElia\Analytics\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\PackageController;
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
    Route::get('package/{package}', [IndexController::class, 'package'])->name('package');
    Route::get('file/{file}', [IndexController::class, 'file'])->name('file');
    Route::get('category/{category}/contracts', [IndexController::class, 'contracts'])->name('contracts');
    Route::get('category/{category}/packages', [IndexController::class, 'packages'])->name('packages');
    Route::get('category/{category}/files', [IndexController::class, 'files'])->name('files');
    Route::get('category/{category}', [IndexController::class, 'category'])->name('category');
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
    Route::get('buy/package/{package}', [PaymentController::class, 'buyPackage'])->name('buyPackage');
    Route::get('buy/file/{file}', [PaymentController::class, 'buyFile'])->name('buyFile');
    Route::get('bought/items', [ProfileController::class, 'boughtItem'])->name('payments');
    Route::get('orders', [ProfileController::class, 'orders'])->name('payments_history');
    Route::any('form/{uuid}/{id}', [PContractController::class, 'form'])->name('form');
    Route::post('form/{uuid}/{id}/confirmation', [PContractController::class, 'form_confirmation'])->name('form_confirmation');
    Route::any('edit/{uuid}/{id}', [PContractController::class, 'editForm'])->name('edit.contract');
    Route::any('generate/{uuid}/{id}', [PContractController::class, 'generate'])->name('generate');
    Route::any('download/{uuid}/contract/{id}', [PContractController::class, 'download'])->name('downloadContract');
    Route::any('download/{uuid}/file/{id}', [\App\Http\Controllers\Profile\FileController::class, 'download'])->name('downloadFile');
});

// Dashboard
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::redirect('admin', 'admin/dashboard');
    Route::redirect('dashboard', 'admin/dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('contract', ContractController::class);
    Route::resource('file', FileController::class);
    Route::resource('package', PackageController::class);
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::view('fillables', 'admin.fillables')->name('fillables');
    Route::post('fillables', [ContractController::class, 'fillables'])->name('fillables');
    Route::get('orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('order/{uuid}/print', [AdminController::class, 'admin_print'])->name('print');
    Route::get('order/{uuid}', [AdminController::class, 'order'])->name('order');
    Route::get('contact-us', [ContactController::class, 'index'])->name('connect-us-list');
    Route::get('contact-us/{contact}/delete', [ContactController::class, 'destroy'])->name('connect-us-delete');
});

Route::get('sitemap.xml', [IndexController::class, 'sitemap']);
