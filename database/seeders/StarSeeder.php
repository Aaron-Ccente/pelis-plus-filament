<?php

namespace Database\Seeders;

use App\Models\Star;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{
    public function run(): void
    {
        $movie = Movie::first();
        $user  = User::first();

        if (!$movie || !$user) {
            return;
        }

        Star::create([
            'movie_id'    => $movie->id,
            'user_id'     => $user->id,
            'start_number'=> 5,
        ]);
    }
}