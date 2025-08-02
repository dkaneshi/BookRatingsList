<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class PageHeader extends Component
{
    public string $name;

    public string $subtitle;

    public function mount(string $subtitle): void
    {
        $this->name = Auth::check() ? Auth::user()->full_name : 'Guest';
        $this->subtitle = $subtitle;
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.page-header');
    }
}
