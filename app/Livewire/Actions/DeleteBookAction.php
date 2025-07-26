<?php

namespace App\Livewire\Actions;

use App\Models\Book;

class DeleteBookAction
{
    public function handle(Book $book): void
    {
        $book->delete();
    }
}
