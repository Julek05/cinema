<?php

namespace App\Contracts;

use App\Film;

interface FilmRepositoryInterface
{
    /**
     * @param mixed[] $film
     * @param string[] $genres
     * @return array
     */
    public function saveFilm(array $film, array $genres): array;

    public function deleteFilm(int $id): void;

    public function getFilm(int $id): Film;

    /**
     * @param array $updatedFilm
     * @param string[] $genres
     * @param int $id
     * @return array
     */
    public function updateFilm(array $updatedFilm, array $genres, int $id): array;
}
