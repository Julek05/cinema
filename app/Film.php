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

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
    }
}
