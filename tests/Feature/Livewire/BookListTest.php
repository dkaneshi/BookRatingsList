<?php

declare(strict_types=1);

use App\Livewire\BookList;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

it('can render the component', function () {
    // Create some books
    Book::factory()->count(3)->create();

    // Test the component renders
    Livewire::test(BookList::class)
        ->assertViewIs('livewire.book-list')
        ->assertViewHas('books');
});

it('displays all books when no search term is provided', function () {
    // Create some books
    $books = Book::factory()->count(3)->create();

    // Test the component displays all books
    Livewire::test(BookList::class)
        ->assertViewHas('books', function ($viewBooks) use ($books) {
            return $viewBooks->count() === $books->count() &&
                   $viewBooks->pluck('id')->sort()->values()->toArray() ===
                   $books->pluck('id')->sort()->values()->toArray();
        });
});

it('filters books by title when search term is provided', function () {
    // Create books with specific titles
    $matchingBook = Book::factory()->create(['title' => 'Test Book']);
    $nonMatchingBook = Book::factory()->create(['title' => 'Another Book']);

    // Test the component filters books by title
    Livewire::test(BookList::class)
        ->set('term', 'Test')
        ->assertViewHas('books', function ($viewBooks) use ($matchingBook) {
            return $viewBooks->count() === 1 &&
                   $viewBooks->first()->id === $matchingBook->id;
        });
});

it('filters books by author when search term is provided', function () {
    // Create books with specific authors
    $matchingBook = Book::factory()->create(['author' => 'John Doe']);
    $nonMatchingBook = Book::factory()->create(['author' => 'Jane Smith']);

    // Test the component filters books by author
    Livewire::test(BookList::class)
        ->set('term', 'John')
        ->assertViewHas('books', function ($viewBooks) use ($matchingBook) {
            return $viewBooks->count() === 1 &&
                   $viewBooks->first()->id === $matchingBook->id;
        });
});

it('returns all books when search term is empty string', function () {
    // Create some books
    $books = Book::factory()->count(3)->create();

    // Test the component returns all books when search term is empty
    Livewire::test(BookList::class)
        ->set('term', '')
        ->assertViewHas('books', function ($viewBooks) use ($books) {
            return $viewBooks->count() === $books->count();
        });
});

it('returns all books when search term is "0"', function () {
    // Create some books
    $books = Book::factory()->count(3)->create();

    // Test the component returns all books when search term is "0"
    Livewire::test(BookList::class)
        ->set('term', '0')
        ->assertViewHas('books', function ($viewBooks) use ($books) {
            return $viewBooks->count() === $books->count();
        });
});

it('can delete a book when user is authenticated', function () {
    // Create a user and a book
    $user = User::factory()->create();
    $book = Book::factory()->create();

    // Test the component can delete a book
    Livewire::actingAs($user)
        ->test(BookList::class)
        ->call('delete', $book)
        ->assertOk();

    // Verify the book was deleted
    $this->assertDatabaseMissing('books', ['id' => $book->id]);
});

it('cannot delete a book when user is not authenticated', function () {
    // Create a book
    $book = Book::factory()->create();

    // Test the component cannot delete a book when user is not authenticated
    // This is because the component has an authorization check
    Livewire::test(BookList::class)
        ->call('delete', $book)
        ->assertOk();

    // Verify the book was NOT deleted
    $this->assertDatabaseHas('books', ['id' => $book->id]);
});
