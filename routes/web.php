<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::view('/', 'welcome');

        Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

        Route::view('profile', 'profile')->middleware(['auth'])->name('profile');
        
        Route::resource('tenant', TenantController::class)->except(['show']);

        require __DIR__ . '/auth.php';
    });
}
