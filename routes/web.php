<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class,'index'])->name('home');

// Contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// À propos
Route::get('/about-us', [HomeController::class, 'about'])->name('about');

// Catégories
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');

// FAQ
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// Liste des véhicules
Route::get('/listing', [HomeController::class, 'listing'])->name('listing');

// Offres spéciales
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');



Route::group(['prefix' => 'auth'], function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

