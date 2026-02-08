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
        Production_company::factory()->count(10)->create();
    }
}
