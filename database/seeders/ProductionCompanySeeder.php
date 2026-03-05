<?php

namespace Database\Seeders;

use App\Models\Production_company;
use Illuminate\Database\Seeder;

class ProductionCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'Warner Bros Pictures'],
            ['name' => 'Legendary Pictures'],
            ['name' => 'Mojang Studios'],
            ['name' => 'Vertigo Entertainment'],
            ['name' => 'On the Roam'],
            ['name' => 'Domain Entertainment'],
            ['name' => 'Walt Disney Pictures'],
            ['name' => 'Marc Platt Productions'],
            ['name' => 'New Line Cinema'],
            ['name' => 'Practical Pictures'],
            ['name' => 'Freshman Year'],
            ['name' => 'Fireside Films'],
            ['name' => 'DNA Films'],
            ['name' => 'Company de prueba update'],
            ['name' => 'Unified Pictures'],
            ['name' => 'Entertainment'],
            ['name' => 'Shaken, Not Stirred Productions'],
            ['name' => 'Paramount Pictures'],
            ['name' => 'Skydance Media'],
            ['name' => 'TC Productions'],
            ['name' => 'MC4'],
            ['name' => 'Gébéka Films'],
            ['name' => 'Kinology'],
            ['name' => 'Marvel Studios'],
            ['name' => 'Kevin Feige Productions'],
            ['name' => 'Constantin Television'],
            ['name' => 'Epo-Film'],
            ['name' => 'Inoxy Films'],
            ['name' => 'Versus Production'],
        ];
        foreach ($companies as $company) {
            Production_company::create($company);
        }
    }
}
