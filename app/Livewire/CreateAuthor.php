<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Actions\InsertAuthorAction;
use App\Livewire\Forms\AuthorForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class CreateAuthor extends Component
{
    public AuthorForm $form;

    public function save(InsertAuthorAction $action): void
    {
        $this->validate();

        $action->handle($this->form);

        $this->redirect('/authors', navigate: true);
    }

    #[Title('Add an Author')]
    #[Layout('components.layouts.booklist')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.create-author');
    }
}
