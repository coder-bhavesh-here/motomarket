<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tour::class;

    public function definition(): array
    {
        return [
            'user_id' => 62,
            'title' => "TEST FAKE TOUR " . $this->faker->sentence(6),
            'riding_style' => $this->faker->randomElement(['Enduro', 'Adventure', 'Road']),
            'riding_style_info' => $this->faker->paragraph(),
            'rider_capability' => $this->faker->randomElement([
                Tour::BEGINNER,
                Tour::INTERMEDIATE,
                Tour::EXPERT
            ]),
            'rider_capability_info' => $this->faker->paragraph(),
            'duration_days' => $this->faker->numberBetween(3, 20),
            'rest_days' => $this->faker->numberBetween(0, 5),
            'max_riders' => $this->faker->numberBetween(5, 15),
            'guides' => $this->faker->numberBetween(1, 3),
            'bike_option' => $this->faker->randomElement([
                Tour::BIKE_INCLUDED,
                Tour::BRING_OWN_BIKE,
                Tour::BIKE_RENTAL
            ]),
            'status' => 'published',
            'rent_gear' => $this->faker->boolean(),
            'two_up_riding' => $this->faker->boolean(),
            'bike_specification' => $this->faker->sentence(8),
            'tour_distance' => $this->faker->numberBetween(200, 2000),
            'countries' => $this->faker->country(),
            'bike_insurance' => $this->faker->boolean(),
            'insurance_notes' => $this->faker->sentence(10),
            'permanently_deleted' => false,
            'tour_description' => $this->faker->paragraph(5),
            'included' => '<ul><li>' . implode('</li><li>', $this->faker->words(5)) . '</li></ul>',
            'not_included' => '<ul><li>' . implode('</li><li>', $this->faker->words(5)) . '</li></ul>',
            // 'location_notes' => $this->faker->sentence(),
            'map_link' => $this->faker->url(),
            'video_one' => $this->faker->url(),
            'video_two' => $this->faker->url(),
            'video_three' => $this->faker->url(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Tour $tour) {
            // 2-4 prices
            \App\Models\TourPrice::factory()->count(rand(2, 4))->create([
                'tour_id' => $tour->id,
            ]);

            // 2-5 images
            \App\Models\TourImage::factory()
                ->count(rand(2, 5))
                ->make() // pehle memory me banayenge
                ->each(function ($image, $index) use ($tour) {
                    $image->tour_id = $tour->id;
                    $image->index = $index; // 0,1,2,...
                    $image->save();
                });
            // 1-3 addon groups with 2-4 addons each
            \App\Models\AddonGroup::factory()
                ->count(rand(1, 3))
                ->create(['tour_id' => $tour->id])
                ->each(function ($group) {
                    \App\Models\Addon::factory()->count(rand(2, 4))->create([
                        'addon_group_id' => $group->id,
                    ]);
                });
        });
    }
}
