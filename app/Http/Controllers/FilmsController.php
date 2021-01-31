<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\FilmRepositoryInterface;
use App\Contracts\GenreRepositoryInterface;
use App\Traits\FilmsTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function getAllFilms()
    {
        $genres = $this->genreRepository->getAllFilms();
        return view('films.films_show', compact('genres'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $genre
     * @return Application|Factory|Response|View
     */
    public function getFilmsByGenre(string $genre)
    {
        $genre = $this->genreRepository->getFilmsByGenre($genre);

        return view('films.films_for_genre', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $genres = $this->genreRepository->getGenres();

        return view('films.film_create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $genres = $this->getGenresFromString($request->get('genres'));

        $responseMessage = $this->filmRepository->saveFilm($request->except('_token', 'genres'), $genres);

        return back()->with($responseMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return Application|Factory|Response|View
     */
    public function edit(string $id)
    {
        $film = $this->filmRepository->getFilm((int) $id);

        $genres = $this->genreRepository->getGenres();

        return view('films.film_update', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, string $id)
    {
        $genres = $this->getGenresFromString($request->get('genres'));

        $responseMessage = $this->filmRepository->updateFilm($request->except('token', 'genres'),
            $genres, (int) $id);

        return back()->with($responseMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->filmRepository->deleteFilm((int)$id);

        return back();
    }
}
