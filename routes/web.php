<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\UserController;


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

Route::resource('makes', MakeController::class);
Route::resource('users', UserController::class);

//route pour l'authentication
Route::group(['prefix' => 'auth'], function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//route pour l'admin
Route::group(['prefix' => 'phenix'], function () {
    Route::get('/', [AdminController::class,'index'])->name('home-admin');
});

//route pour le compte client
Route::group(['prefix' => 'customers'], function () {


});

