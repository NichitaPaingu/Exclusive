<?php
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardViewController;
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
Route::get('/login', [AuthViewController::class, 'create'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/profile/payment', [DashboardViewController::class, 'payment']);
    Route::get('/profile/returns', [DashboardViewController::class, 'returns']);
    Route::get('/profile/cancellations', [DashboardViewController::class, 'cancellations']);
    Route::get('/profile/wishlist', [DashboardViewController::class, 'wishlist']);
    Route::get('/profile/cart', [DashboardViewController::class, 'cart']);

    Route::get('/profile/info', [ProfileController::class, 'show']);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/address', [AddressController::class, 'show']);
    Route::get('/profile/address/edit', [AddressController::class, 'edit'])->name('profile.address.edit');
    Route::post('/profile/address/update', [AddressController::class, 'update'])->name('profile.address.update');
    Route::get('/profile/address/create', [AddressController::class, 'create'])->name('profile.address.create');
    Route::post('/profile/address/store', [AddressController::class, 'store'])->name('profile.address.store');

    Route::get('/wishlist', function () {
        return view('wishlist.show');
    })->name('wishlist');

    Route::get('/cart', function () {
        return view('cart.show');
    })->name('cart');
});


Route::get('/auth-check', function () {
    return response()->json(['authenticated' => Auth::check()]);
});




