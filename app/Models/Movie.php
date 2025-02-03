<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{

    use HasFactory;

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(MovieList::class, 'list_movie', 'movie_id', 'list_id')
            ->withTimestamps();
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id')
            ->withTimestamps();
    }
}
