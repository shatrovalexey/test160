<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Region, City, Street};

class AddressSeeder extends Seeder
{
    protected $model = Street::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i ++) {
            $region = new Region();
            $region->name = fake()->unique()->name();
            $region->save();
            
            for($j = 0; $j < 50; $j ++) {
                $city = new City();
                $city->region_name = $region->name;
                $city->name = fake()->unique()->name();
                $city->save();

                for ($k = 0; $k < 50; $k ++) {
                    $street = new Street();
                    $street->region_name = $region->name;
                    $street->city_name = $city->name;
                    $street->name = fake()->unique()->name();

                    $street->save();
                }
            }
        }
    }
}