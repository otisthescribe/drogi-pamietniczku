<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('intro');
})->name('intro');

Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/events', [EventController::class, 'list'])->name('admin.events')->middleware('auth');
Route::get('/admin/events/edit/{id}', [EventController::class, 'edit'])->name('admin.events.edit')->middleware('auth');
Route::patch('/admin/events/update/{id}', [EventController::class, 'update'])->name('admin.events.update')->middleware('auth');
Route::delete('/admin/events/destroy/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy')->middleware('auth');

Route::get('/admin/categories', [CategoryController::class, 'list'])->name('admin.categories')->middleware('auth');
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit')->middleware('auth');
Route::patch('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update')->middleware('auth');
Route::delete('/admin/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy')->middleware('auth');

require __DIR__.'/auth.php';
