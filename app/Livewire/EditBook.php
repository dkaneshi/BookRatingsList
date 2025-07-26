<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Actions\UpdateBookAction;
use App\Livewire\Forms\BookForm;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class EditBook extends Component
{
    public BookForm $form;

    public Book $book;

    public function mount(Book $book): void
    {
        $this->form->title = $book->title;
        $this->form->author = $book->author;
        $this->form->rating = $book->rating;
    }

    public function save(UpdateBookAction $action): void
    {
        $this->validate();

        $action->handle($this->book, $this->form);

        $this->redirect('/books', navigate: true);
    }

    #[Title('Edit Book')]
    #[Layout('components.layouts.booklist')]
    public function render()
    {
        return view('livewire.edit-book');
    }
}
