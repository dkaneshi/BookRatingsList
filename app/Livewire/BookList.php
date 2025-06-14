<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BookList extends Component
{
    #[Layout('components.layouts.booklist')]
    #[Title('Book List - Home')]
    public function render()
    {
        return view('livewire.book-list', [
            'books' => Book::all(),
        ]);
    }
}
