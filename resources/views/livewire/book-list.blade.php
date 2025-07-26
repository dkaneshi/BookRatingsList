<div>
    <livewire:page-header subtitle="Here's a list of books..."/>

    <div class="flex max-w-md m-auto my-4">
        <flux:input type="text" placeholder="Search by title or author..." wire:model.live.debounce.300ms="term">
        </flux:input>
    </div>
    <ul class="list">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($books as $book)
                <li wire:key="{{ $book->id }}">
                    <flux:card size="sm" class="hover:bg-zinc-50 dark:hover:bg-zinc-700">
                        @auth
                            <flux:button
                                class="float-end mt-2"
                                wire:click="delete({{ $book->id }})"
                                aria-label="Delete book: {{ $book->title }}"
                                wire:confirm.prompt="Are you sure you?\n\nType DELETE to confirm|DELETE"
                                icon="trash"
                                alt="Delete">
                            </flux:button>
                            <flux:button
                                class="float-end mt-2"
                                href="/books/edit/{{ $book->id }}"
                                aria-label="Edit book: {{ $book->title }}"
                                icon="pencil"
                                alt="Edit">
                            </flux:button>
                        @endauth
                        <flux:heading class="flex items-center gap-2">{{ $book->title }}</flux:heading>
                        <flux:text class="mt-2">{{ $book->author }}</flux:text>
                        <flux:text>Rating: {{ $book->rating }}/10</flux:text>
                    </flux:card>
                </li>
            @endforeach
        </div>
    </ul>
</div>
