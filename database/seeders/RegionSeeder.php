<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Database\Factories\RegionFactory;
use App\Models\{Region, City, Street};

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function definition(): array
    {
        return ['name' => fake()->unique()->name(),];
    }
}