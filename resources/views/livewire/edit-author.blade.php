<div>
    <livewire:page-header subtitle="Edit author..."/>

    <div class="max-w-md m-auto">
        <form wire:submit="save">
            <div class="mb-4">
                <flux:field>
                    <flux:label for="name">Name</flux:label>

                    <flux:input wire:model="form.name" id="name" required/>

                    <flux:error name="form.name"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field>
                    <flux:label for="bio">Biography</flux:label>

                    <flux:textarea wire:model="form.bio" id="bio" rows="5"/>

                    <flux:error name="form.bio"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field>
                    <flux:label for="website">Website</flux:label>

                    <flux:input type="url" wire:model="form.website" id="website" placeholder="https://example.com"/>

                    <flux:error name="form.website"/>
                </flux:field>
            </div>

            <div class="mb-4">
                <flux:field>
                    <flux:label for="photo">Photo URL</flux:label>

                    <flux:input wire:model="form.photo" id="photo" placeholder="https://example.com/photo.jpg"/>

                    <flux:error name="form.photo"/>
                </flux:field>
            </div>

            <flux:button type="submit" class="mt-4">Update Author</flux:button>
        </form>
    </div>
</div>