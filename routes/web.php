<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/universities', [UniversityController::class, 'index'])
        ->middleware('can:view-universities')
        ->name('universities.index');
    Route::get('/universities/create', [UniversityController::class, 'create'])
        ->middleware('can:view-universities')
        ->name('universities.create');
    Route::post('/universities', [UniversityController::class, 'store'])
        ->middleware('can:view-universities')
        ->name('universities.store');
    Route::get('/universities/{university}/edit', [UniversityController::class, 'edit'])
        ->middleware('can:view-universities')
        ->name('universities.edit');
    Route::put('/universities/{university}', [UniversityController::class, 'update'])
        ->middleware('can:view-universities')
        ->name('universities.update');
    Route::delete('/universities/{university}', [UniversityController::class, 'destroy'])
        ->middleware('can:view-universities')
        ->name('universities.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
