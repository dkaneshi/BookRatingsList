<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Actions\InsertBookAction;
use App\Livewire\Forms\BookForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class CreateBook extends Component
{
    public BookForm $form;

    public function save(InsertBookAction $action): void
    {
        $this->validate();

        $action->handle($this->form);

        $this->redirect('/books', navigate: true);
    }

    #[Title('Add a Book')]
    #[Layout('components.layouts.booklist')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.create-book');
    }
}
