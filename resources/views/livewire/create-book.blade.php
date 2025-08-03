<div>
    <livewire:page-header subtitle="Add a book..."/>

    <div class="max-w-md m-auto">
        <form wire:submit="save">
            <div class="mb-4">
                <flux:field>
                    <flux:label for="title">Title</flux:label>

                    <flux:input wire:model="form.title" id="title"/>

                    <flux:error name="form.title"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field>
                    <flux:label for="authors">Authors</flux:label>

                    <flux:select multiple wire:model="form.authors" id="authors" size="5">
                        @foreach($authors as $author)
                            <flux:select.option value="{{ $author->id }}">{{ $author->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    
                    <flux:description>Hold Ctrl/Cmd to select multiple authors</flux:description>

                    <flux:error name="form.authors"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field class="mb-4">
                    <flux:label for="rating">Rating</flux:label>

                    <flux:input type="number" wire:model="form.rating" id="rating"/>

                    <flux:error name="form.rating"/>
                </flux:field>
            </div>

            <flux:button type="submit" class="mt-4">Save</flux:button>
        </form>
    </div>
</div>
