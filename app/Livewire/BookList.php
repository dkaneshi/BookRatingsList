<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class BookList extends Component
{
    public string $term = '';

    public function delete(Book $book): void
    {
        if (Auth::check()) {
            $book->delete();
        }
    }

    #[Layout('components.layouts.booklist')]
    #[Title('Book List - Home')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        if ($this->term !== '' && $this->term !== '0') {
            $books = Book::query()
                ->where('title', 'like', "%{$this->term}%")
                ->orWhere('author', 'like', "%{$this->term}%")
                ->get();
        } else {
            $books = Book::all();
        }

        return view('livewire.book-list', [
            'books' => $books,
        ]);
    }
}
