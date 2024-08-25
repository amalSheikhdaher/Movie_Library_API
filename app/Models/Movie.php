<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'director',  
        'genre', 
        'release_year',
        'description',
    ];

    /**
     * Get the ratings associated with the movie.
     * 
     * This method defines a one-to-many relationship between the Movie model
     * and the Rating model. A movie can have many ratings, but each rating belongs to a single movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
