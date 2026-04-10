<?php

namespace Tests\Feature\Feature;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_and_creates_genres(): void
    {
        Genre::factory()->count(2)->create();

        $this->getJson('/api/genres')
            ->assertOk()
            ->assertJsonCount(2);

        $this->postJson('/api/genres', [
            'name' => 'Fantasia',
            'description' => 'Livros com mundos imaginários.',
        ])
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'Fantasia',
            ]);

        $this->assertDatabaseHas('genres', [
            'name' => 'Fantasia',
        ]);
    }

    public function test_it_shows_updates_and_deletes_a_genre(): void
    {
        $genre = Genre::factory()->create([
            'name' => 'Romance',
        ]);

        $this->getJson("/api/genres/{$genre->id}")
            ->assertOk()
            ->assertJsonPath('name', 'Romance');

        $this->putJson("/api/genres/{$genre->id}", [
            'name' => 'Romance Histórico',
            'description' => 'Narrativas ambientadas em outras épocas.',
        ])
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Romance Histórico',
            ]);

        $this->deleteJson("/api/genres/{$genre->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('genres', [
            'id' => $genre->id,
        ]);
    }

    public function test_it_lists_books_for_a_specific_genre(): void
    {
        $genre = Genre::factory()->create();

        Book::factory()->count(2)->for($genre)->create();
        Book::factory()->create();

        $this->getJson("/api/genres/{$genre->id}/books")
            ->assertOk()
            ->assertJsonCount(2);
    }
}
