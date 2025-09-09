<?php

namespace Database\Factories;

use App\Models\TourImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourImage>
 */
class TourImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TourImage::class;

    public function definition(): array
    {
        return [
            'image_path' => "uploads/1754905797_4166299E-1883-46A9-8A5A-EFEBB2FBE781_1_105_c.jpeg",
            'index' => 0
        ];
    }
}
