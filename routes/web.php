<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\AuthViewController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about.about');
})->name('about');
Route::get('/contact', function () {
    return view('contact.contact');
})->name('contact');
Route::get('/404', function () {
    return view('errors.404');
})->name('404');

// AJAX routes
Route::get('/ajax/register', [AuthViewController::class, 'showRegisterForm']);
Route::get('/ajax/login', [AuthViewController::class, 'showLoginForm']);
Route::get('/auth', [AuthViewController::class, 'create'])->name('auth');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Profile
Route::get('/profile/info', [ProfileViewController::class, 'info']);
Route::get('/profile/address', [ProfileViewController::class, 'address']);
Route::get('/profile/payment', [ProfileViewController::class, 'payment']);
Route::get('/profile/returns', [ProfileViewController::class, 'returns']);
Route::get('/profile/cancellations', [ProfileViewController::class, 'cancellations']);
Route::get('/profile/wishlist', [ProfileViewController::class, 'wishlist']);
Route::get('/profile/cart', [ProfileViewController::class, 'cart']);

Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

