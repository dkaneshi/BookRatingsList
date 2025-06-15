<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BookList extends Component
{
    public string $term = '';

    public function delete(Book $book): void
    {
        $book->delete();
    }

    #[Layout('components.layouts.booklist')]
    #[Title('Book List - Home')]
    public function render()
    {
        if ($this->term) {
            $books = Book::query()->where('title', 'like', "%{$this->term}%")->get();
        } else {
            $books = Book::all();
        }
        return view('livewire.book-list', [
            'books' => $books,
        ]);
    }
}
