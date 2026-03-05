<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Acción'], 
            ['name' => 'Aventura'], 
            ['name' => 'Bélica'], 
            ['name' => 'Ciencia ficción'], 
            ['name' => 'Comedia'], 
            ['name' => 'Crimen'], 
            ['name' => 'Documental'], 
            ['name' => 'Drama'], 
            ['name' => 'Familia'], 
            ['name' => 'Fantasía'], 
            ['name' => 'Misterio'], 
            ['name' => 'Suspense'], 
            ['name' => 'Terror'], 
        ];
        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }

}
