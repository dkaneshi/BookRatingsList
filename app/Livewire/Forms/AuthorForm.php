<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

final class AuthorForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:5000')]
    public ?string $bio = null;

    #[Validate('nullable|url|max:255')]
    public ?string $website = null;

    #[Validate('nullable|string|max:255')]
    public ?string $photo = null;
}
