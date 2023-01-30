<?php

namespace Database\Factories;

use App\Models\Serial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SerialEpisodeSeason>
 */
class SerialEpisodeSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'season_number' => $this->faker->numberBetween(1, 10),
            'description' => [
                'ru' => $this->faker->text(100),
                'en' => $this->faker->text(100),
            ],
            'rate' => $this->faker->randomFloat(2, 0, 10),
            'is_final' => $this->faker->boolean,
            'year' => $this->faker->year,
            'serial_id' => Serial::query()->inRandomOrder()->first()->id,
        ];
    }
}
