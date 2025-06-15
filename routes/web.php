<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// --- Admin Panel Routes ---
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Resources (will add these controllers below)
    // About Me (Singleton)
    Route::get('/about-me', [App\Http\Controllers\Admin\AdminAboutMeController::class, 'edit'])->name('about-me.edit');
    Route::put('/about-me', [App\Http\Controllers\Admin\AdminAboutMeController::class, 'update'])->name('about-me.update');

    // Skills
    Route::resource('skills', App\Http\Controllers\Admin\AdminSkillController::class);

    // Projects
    Route::resource('projects', App\Http\Controllers\Admin\AdminProjectController::class);

    // Contact Messages
    Route::get('contact-messages', [App\Http\Controllers\Admin\AdminContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::patch('contact-messages/{contactMessage}/mark-read', [App\Http\Controllers\Admin\AdminContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::delete('contact-messages/{contactMessage}', [App\Http\Controllers\Admin\AdminContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
});

require __DIR__ . '/auth.php';
