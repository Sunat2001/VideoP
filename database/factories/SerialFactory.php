<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serial>
 */
class SerialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'ru' => $this->faker->name,
                'en' => $this->faker->name,
            ],
            'description' => [
                'ru' => $this->faker->text,
                'en' => $this->faker->text,
            ],
            'image_cover' => $this->faker->imageUrl(),
            'rate' => $this->faker->randomFloat(1, 0, 9),
        ];
    }
}
