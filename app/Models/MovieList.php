<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieList extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = [
        'title',
        'description',
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'list_movie', 'list_id', 'movie_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'list_user', 'list_id', 'user_id')
            ->withPivot('status', 'role')
            ->withTimestamps();
    }

    public function isOwnedBy(int $id)
    {
        return $this->users()
            ->where('user_id', $id)
            ->wherePivot('role', 'owner')
            ->exists();
    }
}
