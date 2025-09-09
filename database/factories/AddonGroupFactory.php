<?php

namespace Database\Factories;

use App\Models\AddonGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddonGroup>
 */
class AddonGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AddonGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'is_required' => $this->faker->boolean(30),
            'is_multiple' => $this->faker->boolean(40),
        ];
    }
}
