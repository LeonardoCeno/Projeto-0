<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Book::query()
                ->with('genre')
                ->orderBy('title')
                ->get()
        );
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());

        return response()->json($book->load('genre'), 201);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book->load('genre'));
    }

    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json($book->fresh()->load('genre'));
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->noContent();
    }
}
