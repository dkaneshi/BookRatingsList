<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class CreateBook extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $title;

    #[Validate('required|string|min:3|max:255')]
    public string $author;

    #[Validate('required|integer|min:1|max:10')]
    public int $rating;

    public function save(): void
    {
        $this->validate();

        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'rating' => $this->rating,
        ]);

        $this->redirect('/books', navigate: true);
    }

    #[Title('Add a Book')]
    #[Layout('components.layouts.booklist')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.create-book');
    }
}
