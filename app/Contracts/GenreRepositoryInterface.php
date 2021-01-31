<?php

namespace App\Contracts;

use App\Genre;
use Illuminate\Database\Eloquent\Collection;

interface GenreRepositoryInterface
{
    public function getGenres(): Collection;

    public function getFilmsByGenre(string $genre): Genre;

    public function getAllFilms(): Collection;
}
