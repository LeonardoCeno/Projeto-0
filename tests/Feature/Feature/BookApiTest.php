<?php

namespace Tests\Feature\Feature;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_and_creates_books(): void
    {
        $genre = Genre::factory()->create();

        Book::factory()->for($genre)->create([
            'title' => 'Duna',
        ]);

        $this->getJson('/api/books')
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'Duna',
            ]);

        $this->postJson('/api/books', [
            'genre_id' => $genre->id,
            'title' => 'Neuromancer',
            'author' => 'William Gibson',
            'pages' => 271,
            'status' => 'reading',
            'rating' => 5,
        ])
            ->assertCreated()
            ->assertJsonFragment([
                'title' => 'Neuromancer',
                'status' => 'reading',
            ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Neuromancer',
            'author' => 'William Gibson',
            'status' => 'reading',
            'rating' => 5,
        ]);
    }

    public function test_it_shows_updates_and_deletes_a_book(): void
    {
        $book = Book::factory()->create([
            'title' => 'O Hobbit',
            'status' => 'to_read',
        ]);

        $this->getJson("/api/books/{$book->id}")
            ->assertOk()
            ->assertJsonPath('title', 'O Hobbit');

        $this->putJson("/api/books/{$book->id}", [
            'genre_id' => $book->genre_id,
            'title' => 'O Hobbit',
            'author' => $book->author,
            'pages' => 310,
            'status' => 'finished',
            'rating' => 5,
        ])
            ->assertOk()
            ->assertJsonFragment([
                'status' => 'finished',
            ]);

        $this->deleteJson("/api/books/{$book->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_it_validates_book_payload(): void
    {
        $this->postJson('/api/books', [
            'genre_id' => 999,
            'title' => '',
            'author' => '',
            'pages' => 'abc',
            'status' => 'invalid',
            'rating' => 8,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'genre_id',
                'title',
                'author',
                'pages',
                'status',
                'rating',
            ]);
    }
}
