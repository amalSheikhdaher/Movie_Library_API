<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'review'
    ];

    /**
     * Get the movie that this rating belongs to.
     * 
     * This method defines a many-to-one relationship between the Rating model
     * and the Movie model. Each rating belongs to a single movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the user that this rating belongs to.
     * 
     * This method defines a many-to-one relationship between the Rating model
     * and the User model. Each rating is given by a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
