<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PageHeader extends Component
{
    public string $name;
    public string $subtitle;

    public function mount($subtitle): void
    {
        $this->name = Auth::check() ? Auth::user()->name : 'Guest';
        $this->subtitle = $subtitle;
    }

    public function render()
    {
        return view('livewire.page-header');
    }
}
