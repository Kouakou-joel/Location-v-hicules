<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\PasswordController ;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehiculeController;

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
Route::resource('reservation', ReservationController::class);
Route::resource('vehicules', VehiculeController::class);
// Route::post('/register', [App\Http\Controllers\RegistrationController::class, 'store'])->name('home-admin');
Route::resource('payements', PayementController::class);

Route::post('/register', [RegisterController::class, 'register'])->name('register-user');


//route pour l'authentication
Route::group(['prefix' => 'auth'], function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('post-login');
    Route::match(['get', 'post'], 'forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
});

// Route for the admin
Route::group(['prefix' => 'phenix'], function () {
    Route::match(['get', 'post'], 'home-admin', [AdminController::class, 'index'])->name('home-admin');
});


Route::group(['prefix' => 'customers', 'middleware' => 'auth'], function () {
    Route::get('profile', [UserController::class, 'showProfile'])->name('customer.profile');
    Route::put('profile/update', [UserController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('reservations', [UserController::class, 'showReservations'])->name('customer.reservations');
    Route::post('/check-email', [UserController::class, 'checkEmail'])->name('email.exist');
    Route::post('/check-pieces', [UserController::class, 'checkPieces'])->name('pieces.exist');
    Route::get('/passwords-change', [PasswordController::class, 'showChangePasswordForm'])->name('passwords.change');
    Route::post('/passwords-change', [PasswordController::class, 'updatePassword'])->name('passwords.update');
    // Ajoutez d'autres routes pour les fonctionnalités client ici
});

