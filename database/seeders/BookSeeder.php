<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

final class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();

        Book::factory()->count(20)->create()->each(function ($book) use ($authors): void {
            // Attach 1-3 random authors to each book
            $book->authors()->attach(
                $authors->random(random_int(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
