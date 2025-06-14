<?php

namespace App\Livewire;

use Livewire\Component;

class PageHeader extends Component
{
    public string $name = 'Dave';
    public string $subtitle;

    public function mount($subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function render()
    {
        return view('livewire.page-header');
    }
}
