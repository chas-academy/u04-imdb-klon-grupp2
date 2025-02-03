<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieList extends Model
{
    use HasFactory;

    protected $table = 'lists';

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'list_movie', 'list_id', 'movie_id');
    }
}
