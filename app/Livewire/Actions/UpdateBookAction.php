<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use App\Livewire\Forms\BookForm;
use App\Models\Book;

final class UpdateBookAction
{
    public function handle(Book $book, BookForm $form): void
    {
        $book->update([
            'title' => $form->title,
            'rating' => $form->rating,
            // Keep author field for backward compatibility
        ]);

        $book->authors()->sync($form->authors);
    }
}
