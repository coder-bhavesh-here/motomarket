<?php

namespace Database\Factories;

use App\Models\TourPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourPrice>
 */
class TourPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TourPrice::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 week', '+6 months');
        $end = (clone $start)->modify('+ ' . $this->faker->numberBetween(5, 15) . ' days');

        return [
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'duration_days' => $this->faker->numberBetween(5, 15),
            'rest_days' => $this->faker->numberBetween(0, 3),
        ];
    }
}
