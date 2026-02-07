<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /** @use HasFactory<\Database\Factories\ActorFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'image_actor',
        'biography',
        'date_of_birth',
    ];

    public function movies()
    {
    return $this->belongsToMany(
        Movie::class,
        'movie_actors',
        'actor_id',
        'movie_id'
    )->withPivot('character_name');
    }
}
