<?php

declare(strict_types=1);

use App\Livewire\AuthorList;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

it('can render the component', function () {
    // Create some authors
    Author::factory()->count(3)->create();

    // Test the component renders
    Livewire::test(AuthorList::class)
        ->assertViewIs('livewire.author-list')
        ->assertViewHas('authors');
});

it('displays all authors when no search term is provided', function () {
    // Create some authors
    $authors = Author::factory()->count(3)->create();

    // Test the component displays all authors
    Livewire::test(AuthorList::class)
        ->assertViewHas('authors', function ($viewAuthors) use ($authors) {
            return $viewAuthors->count() === $authors->count();
        });
});

it('filters authors by name when search term is provided', function () {
    // Create authors with specific names
    $matchingAuthor = Author::factory()->create(['name' => 'Stephen King']);
    $nonMatchingAuthor = Author::factory()->create(['name' => 'J.K. Rowling']);

    // Test the component filters authors by name
    Livewire::test(AuthorList::class)
        ->set('term', 'Stephen')
        ->assertViewHas('authors', function ($viewAuthors) use ($matchingAuthor) {
            return $viewAuthors->count() === 1 &&
                   $viewAuthors->first()->id === $matchingAuthor->id;
        });
});

it('returns all authors when search term is empty string', function () {
    // Create some authors
    $authors = Author::factory()->count(3)->create();

    // Test the component returns all authors when search term is empty
    Livewire::test(AuthorList::class)
        ->set('term', '')
        ->assertViewHas('authors', function ($viewAuthors) use ($authors) {
            return $viewAuthors->count() === $authors->count();
        });
});

it('can delete an author when user is authenticated and author has no books', function () {
    // Create a user and an author with no books
    $user = User::factory()->create();
    $author = Author::factory()->create();

    // Test the component can delete an author
    Livewire::actingAs($user)
        ->test(AuthorList::class)
        ->call('delete', $author)
        ->assertOk();

    // Verify the author was deleted
    $this->assertDatabaseMissing('authors', ['id' => $author->id]);
});

it('cannot delete an author when user is authenticated but author has books', function () {
    // Create a user and an author with books
    $user = User::factory()->create();
    $author = Author::factory()->create();
    $book = Book::factory()->create();
    $book->authors()->attach($author);

    // Test the component cannot delete an author with books
    Livewire::actingAs($user)
        ->test(AuthorList::class)
        ->call('delete', $author)
        ->assertOk();

    // Verify the author was NOT deleted
    $this->assertDatabaseHas('authors', ['id' => $author->id]);
});

it('cannot delete an author when user is not authenticated', function () {
    // Create an author
    $author = Author::factory()->create();

    // Test the component cannot delete an author when not authenticated
    Livewire::test(AuthorList::class)
        ->call('delete', $author)
        ->assertOk();

    // Verify the author was NOT deleted
    $this->assertDatabaseHas('authors', ['id' => $author->id]);
});
