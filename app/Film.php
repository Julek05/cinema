<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    protected $fillable = [
      'title',
      'release_date',
    ];

    /**
     * @param mixed[] $film
//     * @param int[] $genres
     * @param string $genres
     */
//    public static function saveFilm(array $film, array $genres): void
    public static function saveFilm(array $film, string $genres): void
    {
       $film = Film::create($film);

       $film->genres()->attach([(int)$genres]);
    }

    public static function deleteFilm(int $id)
    {
        $film = self::findOrFail($id);

        $film->genres()->detach();
        $film->delete();
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
    }
}
