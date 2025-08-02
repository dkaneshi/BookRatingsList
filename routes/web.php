<?php

declare(strict_types=1);

use App\Livewire\AuthorList;
use App\Livewire\BookList;
use App\Livewire\CreateAuthor;
use App\Livewire\CreateBook;
use App\Livewire\EditAuthor;
use App\Livewire\EditBook;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\ShowAuthor;
use Illuminate\Support\Facades\Route;

Route::get('/', BookList::class)->name('home');
Route::get('/books', BookList::class)->name('books.index');
Route::get('/books/create', CreateBook::class)->middleware('auth')->name('books.create');
Route::get('/books/edit/{book}', EditBook::class)->middleware('auth')->name('books.edit');

Route::get('/authors', AuthorList::class)->name('authors.index');
Route::get('/authors/create', CreateAuthor::class)->middleware('auth')->name('authors.create');
Route::get('/authors/edit/{author}', EditAuthor::class)->middleware('auth')->name('authors.edit');
Route::get('/authors/{author}', ShowAuthor::class)->name('authors.show');

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
