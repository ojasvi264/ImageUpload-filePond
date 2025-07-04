<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\MultipleImageUploadController;
use App\Http\Controllers\UploadController;

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

    Route::get('/image/create', [ImageUploadController::class, 'create'])->name('image.create');
    Route::get('/image/list', [ImageUploadController::class, 'list'])->name('image.list');
    Route::post('/image/store', [ImageUploadController::class, 'store'])->name('image.store');
    Route::delete('/image/{image}/destroy', [ImageUploadController::class, 'destroy'])->name('image.destroy');

    Route::get('/multiple-image/create', [MultipleImageUploadController::class, 'create'])->name('multiple_image.create');
    Route::get('/multiple-image/list', [MultipleImageUploadController::class, 'list'])->name('multiple_image.list');

    Route::post('/multiple-image/store', [MultipleImageUploadController::class, 'multipleStore'])->name('multiple_image.store');

    Route::post('/upload', [UploadController::class, 'store'])->name('image.upload');
    Route::delete('/upload', [UploadController::class, 'destroy'])->name('image.delete');
});

require __DIR__.'/auth.php';
