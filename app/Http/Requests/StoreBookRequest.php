<?php

namespace App\Http\Requests;

use App\Enums\BookStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'genre_id' => ['required', 'integer', 'exists:genres,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', Rule::in(BookStatus::values())],
            'rating' => ['nullable', 'integer', 'between:1,5'],
        ];
    }
}
