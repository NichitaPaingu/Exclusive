<?php
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['api', 'web'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'store']);
});
Route::middleware(['auth', 'api', 'web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);
});

