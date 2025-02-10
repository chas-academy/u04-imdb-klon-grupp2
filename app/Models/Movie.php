<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'year',
        'duration',
        'description',
        'poster',
        'cover_image',
        'rating_average',
        'rating_amount',
    ];

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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function updateRating()
    {
        $average = $this->reviews()->avg('rating') ?? 0;
        $amount = $this->rating_amount + 1;

        $this->update(['rating_average' => $average, 'rating_amount' => $amount]);
    }
}
