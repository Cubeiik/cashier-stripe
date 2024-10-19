<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pricing', function () {
    return Inertia::render('Pricing', [
        'checkoutPrices' =>['monthlyPlan' => 'price_1QBGrcLLPuMGGl8ZU7yVFZml', 'yearlyPlan' => 'price_1QBGrcLLPuMGGl8ZwdLHlGMr', 'permPlan' => 'price_1QBGrcLLPuMGGl8ZwNVuAKXX'],
    ]);
})->middleware(['auth', 'verified'])->name('pricing');

Route::get('/checkout/{plan?}', CheckoutController::class)
->middleware(['auth', 'verified'])
->name('checkout');

Route::get('/success', function () {
    return Inertia::render('Success');
})->middleware(['auth', 'verified'])->name('success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
