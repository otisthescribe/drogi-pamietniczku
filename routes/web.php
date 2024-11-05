<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('intro');
})->name('intro');

Route::get('/events', [EventController::class, 'index'])->name('events.show');

Route::get('/dashboard', function() {
    return redirect()->intended(route('dashboard', absolute: false));
})->name('dashboard');;

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
