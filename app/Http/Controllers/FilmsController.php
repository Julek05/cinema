<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\FilmRepositoryInterface;
use App\Contracts\GenreRepositoryInterface;
use App\Traits\FilmsTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    use FilmsTrait;
    private FilmRepositoryInterface $filmRepository;
    private GenreRepositoryInterface $genreRepository;

    public function __construct(FilmRepositoryInterface $filmRepository, GenreRepositoryInterface $genreRepository)
    {
        $this->middleware('auth');
        $this->filmRepository = $filmRepository;
        $this->genreRepository = $genreRepository;
    }

    public function getAllFilms()
    {
        $genres = $this->genreRepository->getAllFilms();

        return view('films.films_show', compact('genres'));
    }

    public function getFilmsByGenre(string $genre)
    {
        $genre = $this->genreRepository->getFilmsByGenre($genre);

        return view('films.films_for_genre', compact('genre'));
    }

    public function create()
    {
        $genres = $this->genreRepository->getActiveGenres(['id', 'name']);

        return view('films.film_create', compact('genres'));
    }

    public function store(Request $request): RedirectResponse
    {
        $genres = $this->getGenresFromString($request->get('genres'));

        $responseMessage = $this->filmRepository->saveFilm($request->except('_token', 'genres'), $genres);

        return back()->with($responseMessage);
    }

    public function edit(string $id)
    {
        $film = $this->filmRepository->getFilm((int) $id);

        $genres = $this->genreRepository->getActiveGenres(['id', 'name', 'active']);

        return view('films.film_update', compact('film', 'genres'));
    }

    public function update(Request $request, string $id)
    {
        $genres = $this->getGenresFromString($request->get('genres'));

        $responseMessage = $this->filmRepository->updateFilm($request->except('token', 'genres'),
            $genres, (int) $id);

        return back()->with($responseMessage);
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->filmRepository->deleteFilm((int)$id);

        return back();
    }
}
