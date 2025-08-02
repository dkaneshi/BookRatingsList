<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ShowAuthor extends Component
{
    public Author $author;

    public function mount(Author $author): void
    {
        $this->author = $author->load('books');
    }

    #[Title('Author Profile')]
    #[Layout('components.layouts.booklist')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.show-author');
    }
}
