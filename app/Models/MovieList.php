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

    // Define the many-to-many relationship with User
    public function users()
    {
        return $this->belongsToMany(User::class, 'list_user', 'list_id', 'user_id')  // Explicitly defining the foreign key and related key
            ->withPivot('status', 'role') // If you want to access pivot data
            ->withTimestamps(); // Automatically manage created_at and updated_at
    }
}
