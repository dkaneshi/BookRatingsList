<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Actions\UpdateAuthorAction;
use App\Livewire\Forms\AuthorForm;
use App\Models\Author;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class EditAuthor extends Component
{
    public AuthorForm $form;

    public Author $author;

    public function mount(Author $author): void
    {
        $this->author = $author;
        $this->form->name = $author->name;
        $this->form->bio = $author->bio;
        $this->form->website = $author->website;
        $this->form->photo = $author->photo;
    }

    public function save(UpdateAuthorAction $action): void
    {
        $this->validate();

        $action->handle($this->author, $this->form);

        $this->redirect('/authors', navigate: true);
    }

    #[Title('Edit Author')]
    #[Layout('components.layouts.booklist')]
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.edit-author');
    }
}
