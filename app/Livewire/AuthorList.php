<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class AuthorList extends Component
{
    public string $term = '';

    public function delete(Author $author): void
    {
        if (Auth::check() && $author->books()->count() === 0) {
            $author->delete();
        }
    }

    #[Layout('components.layouts.booklist')]
    #[Title('Authors')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        if ($this->term !== '' && $this->term !== '0') {
            $authors = Author::query()
                ->where('name', 'like', "%{$this->term}%")
                ->orderBy('name')
                ->withCount('books')
                ->get();
        } else {
            $authors = Author::query()
                ->orderBy('name')
                ->withCount('books')
                ->get();
        }

        return view('livewire.author-list', [
            'authors' => $authors,
        ]);
    }
}
