<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\GenreRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    private GenreRepositoryInterface $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function getAllGenres()
    {
        $genres = $this->genreRepository->getAllGenres(['id', 'name', 'active']);

        return view('genres.genres_show', compact('genres'));
    }

    public function create()
    {
        return view('genres.genre_create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->genreRepository->store($request->except('_token'));

        return back()->with(['success' => 'Genre created succesfully']);
    }

    public function edit(string $id)
    {
        $genre = $this->genreRepository->getSpecificGenre((int) $id);

        return view('genres.genre_edit', compact('genre'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $this->genreRepository->update($request->except('_token'), (int) $id);

        return back()->with(['success' => 'Genre created succesfully']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->genreRepository->destroy((int) $id);

        return back()->with(['success' => 'Genre created succesfully']);
    }
}
