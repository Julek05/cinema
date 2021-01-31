<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function getAllFilms()
    {
        $genres = (new Genre)->getAllFilms();
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
        $genre = Genre::getFilmsByGenre($genre);

        return view('films.films_for_genre', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $genres = Genre::getGenres();

        return view('films.film_create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $genres = $this->getGenresFromString($request->get('genres'));

        $responseMessage = Film::saveFilm($request->except('_token', 'genres'), $genres);

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
        $film = Film::getFilm((int) $id);

        $genres = Genre::getGenres();

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

        $responseMessage = Film::updateFilm($request->except('token', 'genres'), $genres, (int) $id);

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
        Film::deleteFilm((int)$id);

        return back();
    }
}
