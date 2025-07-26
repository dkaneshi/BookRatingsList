<?php

declare(strict_types=1);

use App\Livewire\BookList;
use App\Livewire\CreateBook;
use App\Livewire\EditBook;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', BookList::class)->name('home');
Route::get('/books', BookList::class)->name('books.index');
Route::get('/books/create', CreateBook::class)->middleware('auth')->name('books.create');
Route::get('/books/edit/{book}', EditBook::class)->middleware('auth')->name('books.edit');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
