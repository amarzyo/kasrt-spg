<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Member\ListMember;
use App\Livewire\Tarikan\ListTarikan;

// Route::view('/', 'welcome')->name('home');

Route::get('/', [homeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Data Member
    Route::get('/members', ListMember::class)->name('members.index');

    // Tarikan Member
    Route::get('/donations', ListTarikan::class)->name('donations.index');
});


require __DIR__ . '/settings.php';
