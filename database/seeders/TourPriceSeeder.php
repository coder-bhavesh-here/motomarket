<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\TourPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = Tour::all()->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            TourPrice::create([
                'tour_id' => $tours[array_rand($tours)],
                'price' => fake()->randomFloat(2, 500, 3000),
                'date' => fake()->date,
            ]);
        }
    }
}
