<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\StatsController;

Route::get('/', [PackageController::class, 'publicPackages']);
// Public feedback submission
Route::post('/feedback', [FeedbackController::class, 'storePublic'])->name('feedback.storePublic');
Route::get('/feedback/overview', [FeedbackController::class, 'getPublicFeedback'])->name('feedback.getPublic');

Route::get('/gallery/wedding', function () {
    return view('gallery.wedding-gallery');
});

Route::get('/gallery/corporate', function () {
    return view('gallery.corporate-gallery');
});

Route::get('/gallery/birthday', function () {
    return view('gallery.birthday-gallery');
});

Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Admin auth & dashboard
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth')->group(function () {
    // Feedback management
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::delete('/admin/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Stats
    Route::get('/admin/stats', [StatsController::class, 'index'])->name('stats.index');
    Route::get('/admin/stats/data', [StatsController::class, 'getStatsData'])->name('stats.data');

    // Messages (admin)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    // Pins
    Route::get('/pins', [PinController::class, 'index'])->name('pins.index');
    Route::post('/pins', [PinController::class, 'store'])->name('pins.store');
    Route::delete('/pins/{pin}', [PinController::class, 'destroy'])->name('pins.destroy');

    // Packages
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::post('/packages/{package}/toggle-status', [PackageController::class, 'toggleStatus'])->name('packages.toggle-status');

    // Photos
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::post('/photos/{photo}/toggle-status', [PhotoController::class, 'toggleStatus'])->name('photos.toggle-status');
    Route::post('/photos/reorder', [PhotoController::class, 'reorder'])->name('photos.reorder');
});



