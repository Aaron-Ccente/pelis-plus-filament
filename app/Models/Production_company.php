<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production_company extends Model
{
    /** @use HasFactory<\Database\Factories\ProductionCompanyFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_production_companies', 'production_company_id', 'movie_id');
    }
}
