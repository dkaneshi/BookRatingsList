<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use App\Livewire\Forms\BookForm;
use App\Models\Book;

final class InsertBookAction
{
    public function handle(BookForm $form): void
    {
        $book = Book::create([
            'title' => $form->title,
            'rating' => $form->rating,
            'author' => '', // Keep for backward compatibility, will be removed later
        ]);

        $book->authors()->attach($form->authors);
    }
}
