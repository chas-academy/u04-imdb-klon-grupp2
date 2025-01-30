<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieList extends Model
{
    protected $table = 'lists';

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(MovieList::class, 'list_id');
    }
}
