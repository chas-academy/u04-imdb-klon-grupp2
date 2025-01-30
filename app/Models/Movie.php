<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    public function lists(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
