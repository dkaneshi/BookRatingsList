<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use App\Models\Book;

final class DeleteBookAction
{
    public function handle(Book $book): void
    {
        $book->delete();
    }
}
