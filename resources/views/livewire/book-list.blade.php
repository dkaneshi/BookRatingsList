<div>
    <livewire:page-header subtitle="Here's a list of books..."/>

    <ul class="list">
    <div class="grid grid-cols-3 gap-4">
        @foreach ($books as $book)
            <a href="#" aria-label="{{ $book->title }}">
                <li wire:key="{{ $book->id }}">
                    <flux:card size="sm" class="hover:bg-zinc-50 dark:hover:bg-zinc-700">
                        <flux:button class="float-end mt-2" wire:click="delete({{ $book->id }})">
                            Delete
                        </flux:button>
                        <flux:heading class="flex items-center gap-2">{{ $book->title }}</flux:heading>
                        <flux:text class="mt-2">{{ $book->author }}</flux:text>
                        <flux:text>Rating: {{ $book->rating }}/10</flux:text>
                    </flux:card>
                </li>
            </a>
        @endforeach
    </div>
    </ul>
</div>
