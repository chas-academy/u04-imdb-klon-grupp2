<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id')
            ->withTimestamps();
    }
}
