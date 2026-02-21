<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    /** @use HasFactory<\Database\Factories\StarFactory> */
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'start_number'    
        ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
