<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
<<<<<<< HEAD
    use HasFactory;

    public function lists(): HasMany
=======
    public function lists(): BelongsToMany
>>>>>>> 8c03deb (fix: add composite key to list_movie table)
    {
        return $this->belongsToMany(MovieList::class, 'list_movie', 'movie_id', 'list_id');
    }
}
