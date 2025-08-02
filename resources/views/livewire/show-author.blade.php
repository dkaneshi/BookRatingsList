<div>
    <livewire:page-header :subtitle="$author->name"/>

    <div class="max-w-4xl mx-auto">
        <flux:card class="mb-6">
            <div class="flex gap-6">
                @if($author->photo)
                    <img src="{{ $author->photo }}" alt="{{ $author->name }}" class="w-32 h-32 rounded-lg object-cover">
                @endif
                
                <div class="flex-1">
                    <flux:heading size="xl" class="mb-2">{{ $author->name }}</flux:heading>
                    
                    @if($author->bio)
                        <flux:text class="mb-4">{{ $author->bio }}</flux:text>
                    @endif
                    
                    @if($author->website)
                        <flux:text>
                            Website: <a href="{{ $author->website }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ $author->website }}
                            </a>
                        </flux:text>
                    @endif
                    
                    <div class="mt-4">
                        <flux:text class="font-semibold">Total Books: {{ $author->books->count() }}</flux:text>
                    </div>
                </div>
                
                @auth
                    <div class="flex gap-2">
                        <flux:button
                            href="/authors/edit/{{ $author->id }}"
                            size="sm"
                            icon="pencil">
                            Edit
                        </flux:button>
                    </div>
                @endauth
            </div>
        </flux:card>

        <flux:heading size="lg" class="mb-4">Books by {{ $author->name }}</flux:heading>
        
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($author->books as $book)
                <flux:card size="sm" class="hover:bg-zinc-50 dark:hover:bg-zinc-700">
                    <flux:heading class="flex items-center gap-2">
                        <a href="/books/edit/{{ $book->id }}" class="hover:underline">
                            {{ $book->title }}
                        </a>
                    </flux:heading>
                    <flux:text>Rating: {{ $book->rating }}/10</flux:text>
                    <flux:text class="mt-2 text-sm">
                        Other authors: 
                        @foreach($book->authors->where('id', '!=', $author->id) as $otherAuthor)
                            <a href="/authors/{{ $otherAuthor->id }}" class="text-blue-600 hover:underline">
                                {{ $otherAuthor->name }}
                            </a>@if(!$loop->last), @endif
                        @endforeach
                        @if($book->authors->where('id', '!=', $author->id)->isEmpty())
                            <span class="text-gray-500">None</span>
                        @endif
                    </flux:text>
                </flux:card>
            @empty
                <flux:text class="col-span-full text-center text-gray-500">
                    No books found for this author.
                </flux:text>
            @endforelse
        </div>
    </div>
</div>