<?php

namespace Database\Seeders;

use App\Enums\BookStatus;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $booksByGenre = [
            'Fantasia' => [
                ['title' => 'O Hobbit', 'author' => 'J.R.R. Tolkien', 'pages' => 310, 'status' => BookStatus::Finished->value, 'rating' => 5],
                ['title' => 'Harry Potter e a Pedra Filosofal', 'author' => 'J.K. Rowling', 'pages' => 264, 'status' => BookStatus::Finished->value, 'rating' => 5],
                ['title' => 'O Nome do Vento', 'author' => 'Patrick Rothfuss', 'pages' => 656, 'status' => BookStatus::Reading->value, 'rating' => 4],
            ],
            'Ficção Científica' => [
                ['title' => 'Duna', 'author' => 'Frank Herbert', 'pages' => 680, 'status' => BookStatus::Finished->value, 'rating' => 5],
                ['title' => 'Neuromancer', 'author' => 'William Gibson', 'pages' => 271, 'status' => BookStatus::ToRead->value, 'rating' => null],
                ['title' => 'Fundação', 'author' => 'Isaac Asimov', 'pages' => 255, 'status' => BookStatus::Reading->value, 'rating' => 4],
            ],
            'Mistério' => [
                ['title' => 'Assassinato no Expresso do Oriente', 'author' => 'Agatha Christie', 'pages' => 256, 'status' => BookStatus::Finished->value, 'rating' => 5],
                ['title' => 'Garota Exemplar', 'author' => 'Gillian Flynn', 'pages' => 416, 'status' => BookStatus::ToRead->value, 'rating' => null],
                ['title' => 'O Silêncio dos Inocentes', 'author' => 'Thomas Harris', 'pages' => 368, 'status' => BookStatus::Reading->value, 'rating' => 4],
            ],
            'Romance' => [
                ['title' => 'Orgulho e Preconceito', 'author' => 'Jane Austen', 'pages' => 424, 'status' => BookStatus::Finished->value, 'rating' => 5],
                ['title' => 'Como Eu Era Antes de Você', 'author' => 'Jojo Moyes', 'pages' => 320, 'status' => BookStatus::ToRead->value, 'rating' => null],
                ['title' => 'Normal People', 'author' => 'Sally Rooney', 'pages' => 288, 'status' => BookStatus::Reading->value, 'rating' => 4],
            ],
        ];

        foreach ($booksByGenre as $genreName => $books) {
            $genre = Genre::query()->where('name', $genreName)->firstOrFail();

            foreach ($books as $book) {
                Book::query()->updateOrCreate(
                    ['title' => $book['title'], 'author' => $book['author']],
                    [...$book, 'genre_id' => $genre->id],
                );
            }
        }
    }
}
