<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use App\Livewire\Forms\AuthorForm;
use App\Models\Author;
use Illuminate\Support\Str;

final class UpdateAuthorAction
{
    public function handle(Author $author, AuthorForm $form): void
    {
        $author->update([
            'name' => $form->name,
            'slug' => Str::slug($form->name),
            'bio' => $form->bio,
            'website' => $form->website,
            'photo' => $form->photo,
        ]);
    }
}
