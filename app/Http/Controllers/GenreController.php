<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Genre::query()
                ->orderBy('name')
                ->get()
        );
    }

    public function store(StoreGenreRequest $request): JsonResponse
    {
        $genre = Genre::create($request->validated());

        return response()->json($genre, 201);
    }

    public function show(Genre $genre): JsonResponse
    {
        return response()->json($genre->loadCount('books'));
    }

    public function update(UpdateGenreRequest $request, Genre $genre): JsonResponse
    {
        $genre->update($request->validated());

        return response()->json($genre->fresh()->loadCount('books'));
    }

    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();

        return response()->noContent();
    }

    public function books(Genre $genre): JsonResponse
    {
        return response()->json(
            $genre->books()
                ->with('genre')
                ->orderBy('title')
                ->get()
        );
    }
}
