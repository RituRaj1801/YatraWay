<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\JsonFileController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store');
Route::post('/admin/logout', [AuthController::class, 'destroy'])->middleware(AdminAuth::class)->name('admin.logout');

Route::middleware(AdminAuth::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [EnquiryController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/enquiries', [EnquiryController::class, 'store'])->name('dashboard.enquiries.store');
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{id}', [EnquiryController::class, 'show'])->name('enquiries.show');
    Route::delete('/enquiries/{id}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');
    Route::get('/json', [JsonFileController::class, 'index'])->name('json.index');
    Route::get('/json/{filename}', [JsonFileController::class, 'edit'])->name('json.edit');
    Route::put('/json/{filename}', [JsonFileController::class, 'update'])->name('json.update');
});
