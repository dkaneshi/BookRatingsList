<?php

declare(strict_types=1);

use App\Livewire\CreateAuthor;
use App\Models\User;
use Livewire\Livewire;

it('can render the component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateAuthor::class)
        ->assertViewIs('livewire.create-author');
});

it('can create a new author with required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateAuthor::class)
        ->set('form.name', 'New Author')
        ->call('save')
        ->assertRedirect('/authors');

    $this->assertDatabaseHas('authors', [
        'name' => 'New Author',
        'slug' => 'new-author',
    ]);
});

it('can create a new author with all fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateAuthor::class)
        ->set('form.name', 'New Author')
        ->set('form.bio', 'This is a bio')
        ->set('form.website', 'https://example.com')
        ->set('form.photo', 'https://example.com/photo.jpg')
        ->call('save')
        ->assertRedirect('/authors');

    $this->assertDatabaseHas('authors', [
        'name' => 'New Author',
        'slug' => 'new-author',
        'bio' => 'This is a bio',
        'website' => 'https://example.com',
        'photo' => 'https://example.com/photo.jpg',
    ]);
});

it('requires name to be provided', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateAuthor::class)
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors(['form.name' => 'required']);
});

it('validates website must be a valid URL', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateAuthor::class)
        ->set('form.name', 'Test Author')
        ->set('form.website', 'not-a-url')
        ->call('save')
        ->assertHasErrors(['form.website' => 'url']);
});
