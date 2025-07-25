<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use App\Livewire\Forms\BookForm;
use App\Models\Book;

final class InsertBookAction
{
    public function handle(BookForm $form): void
    {
        Book::create($form->all());
    }
}
