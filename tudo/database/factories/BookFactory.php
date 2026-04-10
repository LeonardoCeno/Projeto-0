<?php

namespace Database\Factories;

use App\Enums\BookStatus;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'genre_id' => Genre::factory(),
            'title' => ucwords(fake()->unique()->words(3, true)),
            'author' => fake()->name(),
            'pages' => fake()->numberBetween(120, 900),
            'status' => fake()->randomElement(BookStatus::values()),
            'rating' => fake()->optional(0.7)->numberBetween(1, 5),
        ];
    }
}
