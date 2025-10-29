<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

// Public home page (guest welcome page)
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// User dashboard (after login)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Search route - MOVED OUTSIDE PROTECTED GROUP
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Product and Service detail pages
Route::get('/products/details/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/services/details/{id}', [ServiceController::class, 'show'])->name('services.show');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registration routes
Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm'])->name('register.user');
Route::post('/register/user', [RegisterController::class, 'registerUser']);

Route::get('/register/seller', [RegisterController::class, 'showSellerRegisterForm'])->name('register.seller');
Route::post('/register/seller', [RegisterController::class, 'registerSeller']);

// Appointment routes
Route::get('/book', [AppointmentController::class, 'create'])->name('book');
Route::get('/available-time-slots', [AppointmentController::class, 'availableTimeSlots'])->name('available.time.slots');

// Public services routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Public product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.all');
Route::get('/products/{category}', [ProductController::class, 'byCategory'])->name('products.category');

// Password reset routes
Route::get('/password/reset', function() {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', function() {
    return back()->with('status', 'Password reset link sent to your email!');
})->name('password.email');

// Protected routes (authenticated users only)
Route::middleware('auth')->group(function () {
    
    // Appointment submission (requires login)
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Seller-only routes
    Route::prefix('seller')->middleware('seller')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'sellerDashboard'])->name('seller.dashboard');
        
        // Add these inside Route::prefix('seller')->middleware('seller')->group(function () {
        Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::put('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
        // Product management routes
        Route::get('/products', [ProductController::class, 'manage'])->name('products.manage');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        
        // Service management routes
        Route::get('/services', [ServiceController::class, 'manage'])->name('services.manage');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
        
        // Appointment management route
        Route::get('/appointments', [AppointmentController::class, 'manage'])->name('appointments.manage');
        
        // Bookings management
        Route::get('/bookings', [AppointmentController::class, 'manage'])->name('bookings.manage');
    });
});