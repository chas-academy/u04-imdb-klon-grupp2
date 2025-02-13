<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'rating',
        'movie_id',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::saved(function ($review) {
            $review->movie->updateRating();
        });

        static::deleted(function ($review) {
            $review->movie->updateRating();
        });
    }

    /**
     * Get the user who wrote the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function isWrittenBy(User $user): bool
    {
        return $this->user()->is($user);
    }
}
