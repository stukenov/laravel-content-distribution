<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/',\App\Livewire\Home::class)->name('home');

Route::get('/content/{name}', \App\Livewire\ContentAbout::class)->name('content.about');
Route::get('/contacts', \App\Livewire\Contacts::class)->name('contacts');
Route::get('/about', \App\Livewire\About::class)->name('about');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/redact/{projectId}', \App\Livewire\Admin\ProjectController::class)->name('redact');
    Route::get('/post', \App\Livewire\Admin\ProjectController::class)->name('post');
    Route::get('/content', \App\Livewire\Admin\AdminContent::class)->name('content');
    Route::get('/analytics', \App\Livewire\Admin\Analytics::class)->name('analytics');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
require __DIR__.'/auth.php';
Route::get('/{category}', \App\Livewire\ShowContent::class)->name('show-content');
