<?php

namespace App\Http\Requests;

use App\Enums\BookStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'genre_id' => ['sometimes', 'required', 'integer', 'exists:genres,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', Rule::in(BookStatus::values())],
            'rating' => ['nullable', 'integer', 'between:1,5'],
        ];
    }
}
