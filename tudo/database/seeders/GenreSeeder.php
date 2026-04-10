<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Fantasia',
                'description' => 'Mundos mágicos, criaturas fantásticas e jornadas épicas.',
            ],
            [
                'name' => 'Ficção Científica',
                'description' => 'Histórias com tecnologia, futuro e exploração do desconhecido.',
            ],
            [
                'name' => 'Mistério',
                'description' => 'Investigações, suspense e reviravoltas.',
            ],
            [
                'name' => 'Romance',
                'description' => 'Narrativas centradas em relações e emoções.',
            ],
        ];

        foreach ($genres as $genre) {
            Genre::query()->updateOrCreate(
                ['name' => $genre['name']],
                $genre,
            );
        }
    }
}
