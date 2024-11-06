<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = Tour::all()->pluck('id')->toArray();

        foreach (range(1, 20) as $index) {
            TourImage::create([
                'tour_id' => $tours[array_rand($tours)],
                'image_path' => fake()->imageUrl(640, 480, 'tour', true),
            ]);
        }
    }
}
