<?php

declare(strict_types=1);

namespace App\Traits;

trait FilmsTrait
{
    /**
     * @param string $genres
     * @return string[]
     */
    public function getGenresFromString(string $genres): array
    {
        return explode(',', $genres);
    }
}
