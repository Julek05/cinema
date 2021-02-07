<?php

namespace App\Contracts;

use App\Genre;
use Illuminate\Database\Eloquent\Collection;

interface GenreRepositoryInterface
{
    public function getActiveGenres(array $neededFields): Collection;

    public function getFilmsByGenre(string $genre): Genre;

    public function getAllFilms(): Collection;

    public function store(array $genre): void;

    public function destroy(int $id): void;

    public function update(array $genre, int $id): void;

    public function getSpecificGenre(int $id): Genre;

    public function getAllGenres(): Collection;
}
