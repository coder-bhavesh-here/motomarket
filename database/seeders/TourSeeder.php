<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            Tour::create([
                'user_id' => 3,
                'title' => fake()->sentence(3),
                'tour_description' => fake()->words(100, true),
                'riding_style' => fake()->randomElement(['Road Trip', 'Adventure', 'Enduro']),
                'riding_style_info' => fake()->paragraph,
                'rider_capability' => fake()->randomElement([Tour::BEGINNER, Tour::INTERMEDIATE, Tour::EXPERT]),
                'rider_capability_info' => fake()->paragraph,
                'duration_days' => fake()->numberBetween(3, 14),
                'rest_days' => fake()->numberBetween(0, 3),
                'max_riders' => fake()->numberBetween(5, 20),
                'guides' => fake()->numberBetween(1, 5),
                'bike_option' => fake()->randomElement([Tour::BIKE_INCLUDED, Tour::BRING_OWN_BIKE, Tour::BIKE_RENTAL]),
                'rent_gear' => fake()->boolean,
                'two_up_riding' => fake()->boolean,
                'bike_specification' => fake()->paragraph,
                'tour_distance' => fake()->numberBetween(100, 2000),
                'countries' => fake()->country,
                'included' => fake()->paragraph,
                'not_included' => fake()->paragraph,
                'map_link' => fake()->url,
                'loation_notes' => fake()->paragraph,
                'video_one' => fake()->url,
                'video_two' => fake()->url,
                'video_three' => fake()->url,
            ]);
        }
    }
}
