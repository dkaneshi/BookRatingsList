<div>
    <livewire:page-header subtitle="Manage your authors"/>

    <div class="flex max-w-md m-auto my-4">
        <flux:input type="text" placeholder="Search authors..." wire:model.live.debounce.300ms="term">
        </flux:input>
    </div>
    
    @auth
        <div class="text-center mb-6">
            <flux:button href="/authors/create" icon="plus">Add New Author</flux:button>
        </div>
    @endauth
    
    <ul class="list">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($authors as $author)
                <li wire:key="{{ $author->id }}">
                    <flux:card size="sm" class="hover:bg-zinc-50 dark:hover:bg-zinc-700">
                        @auth
                            <flux:button
                                class="float-end mt-2"
                                wire:click="delete({{ $author->id }})"
                                aria-label="Delete author: {{ $author->name }}"
                                wire:confirm.prompt="Are you sure you?\n\nType DELETE to confirm|DELETE"
                                size="sm"
                                icon="trash"
                                tooltip="Delete"
                                :disabled="$author->books_count > 0">
                            </flux:button>
                            <flux:button
                                class="float-end mt-2"
                                href="/authors/edit/{{ $author->id }}"
                                aria-label="Edit author: {{ $author->name }}"
                                size="sm"
                                icon="pencil"
                                tooltip="Edit">
                            </flux:button>
                        @endauth
                        <flux:heading class="flex items-center gap-2">
                            <a href="/authors/{{ $author->id }}" class="hover:underline">
                                {{ $author->name }}
                            </a>
                        </flux:heading>
                        <flux:text class="mt-2">{{ Str::limit($author->bio, 100) }}</flux:text>
                        <flux:text>Books: {{ $author->books_count }}</flux:text>
                        @if($author->website)
                            <flux:text class="mt-1">
                                <a href="{{ $author->website }}" target="_blank" class="text-blue-600 hover:underline">
                                    Website
                                </a>
                            </flux:text>
                        @endif
                    </flux:card>
                </li>
            @endforeach
        </div>
    </ul>
</div>