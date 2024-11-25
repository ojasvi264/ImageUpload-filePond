<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/image/create', [\App\Http\Controllers\ImageUploadController::class, 'create'])->name('image.create');
Route::get('/image/list', [\App\Http\Controllers\ImageUploadController::class, 'list'])->name('image.list');
Route::post('/image/store', [\App\Http\Controllers\ImageUploadController::class, 'store'])->name('image.store');
Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'store'])->name('image.upload');
require __DIR__.'/auth.php';
