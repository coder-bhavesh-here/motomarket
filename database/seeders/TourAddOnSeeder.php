<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\TourAddOn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourAddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = Tour::all()->pluck('id')->toArray();

        foreach (range(1, 15) as $index) {
            TourAddOn::create([
                'tour_id' => $tours[array_rand($tours)],
                'addon' => fake()->word,
                'addon_price' => fake()->randomFloat(2, 50, 300),
            ]);
        }
    }
}
