<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
     protected $fillable = [
        'title',
        'description',
        'release_year',
        'photo_url',
        'background_url',
        'trailer_url',
    ];

    public function actors()
    {
        return $this->belongsToMany(
            Actor::class,  
            'movie_actors',   
            'movie_id',       
            'actor_id'           
        )->withPivot('character_name');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movies', 'movie_id', 'genre_id');
    }
    public function productionCompanies()
    {
        return $this->belongsToMany(Production_Company::class, 'movie_production_companies', 'movie_id','production_company_id');
    }

    public function usersWhoSaved()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('saved_at');
    }
}
