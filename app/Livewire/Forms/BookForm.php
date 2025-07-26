<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

final class BookForm extends Form
{
    #[Validate('required|string|min:3|max:255', onUpdate: false)]
    public string $title = '';

    #[Validate('required|string|min:3|max:255', onUpdate: false)]
    public string $author = '';

    #[Validate('required|int|min:1|max:10', onUpdate: false)]
    public int $rating = 1;
}
