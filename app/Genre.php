<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'order',
        'active'
    ];

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'films_genres');
    }
}
