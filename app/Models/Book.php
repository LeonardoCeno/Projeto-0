<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'title',
        'author',
        'pages',
        'status',
        'rating',
    ];

    protected function casts(): array
    {
        return [
            'pages' => 'integer',
            'rating' => 'integer',
            'status' => BookStatus::class,
        ];
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
