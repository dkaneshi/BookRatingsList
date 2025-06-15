<div>
    <livewire:page-header subtitle="Add a book..."/>

    <div class="max-w-md m-auto">
        <form wire:submit="save">
            <div class="mb-4">
                <flux:field>
                    <flux:label for="title">Title</flux:label>

                    <flux:input wire:model="title"/>

                    <flux:error name="title"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field>
                    <flux:label for="author">Author</flux:label>

                    <flux:input wire:model="author"/>

                    <flux:error name="author"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field class="mb-4">
                    <flux:label for="rating">Rating</flux:label>

                    <flux:input wire:model="rating"/>

                    <flux:error name="rating"/>
                </flux:field>
            </div>

            <flux:button type="submit" class="mt-4">Save</flux:button>
        </form>
    </div>
</div>
