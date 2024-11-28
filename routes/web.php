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

Route::get('/multiple-image/create', [\App\Http\Controllers\MultipleImageUploadController::class, 'create'])->name('multiple_image.create');
Route::get('/multiple-image/list', [\App\Http\Controllers\MultipleImageUploadController::class, 'list'])->name('multiple_image.list');

Route::post('/multiple-image/store', [\App\Http\Controllers\MultipleImageUploadController::class, 'multipleStore'])->name('multiple_image.store');

Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'store'])->name('image.upload');
Route::delete('/upload', [\App\Http\Controllers\UploadController::class, 'destroy'])->name('image.delete');

require __DIR__.'/auth.php';
