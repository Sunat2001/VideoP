<?php

namespace Database\Factories;

use App\Models\Serial;
use App\Models\SerialEpisodeSeason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SerialEpisode>
 */
class SerialEpisodeFactory extends Factory
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
            'rate' => $this->faker->randomFloat(2, 0, 9),
            'serial_number' => $this->faker->randomNumber(2),
            'serial_id' => Serial::query()->inRandomOrder()->first()->id,
            'season_id' => SerialEpisodeSeason::query()->inRandomOrder()->first()->id,
        ];
    }
}
