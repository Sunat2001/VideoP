<?php

namespace Database\Factories;

use App\Models\SerialEpisode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SerialEpisodeVideo>
 */
class SerialEpisodeVideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quality' => $this->faker->randomElement(['1080', '720', '480', '360']),
            'format' => $this->faker->randomElement(['mp4', 'mkv', 'avi']),
            'video_url' => $this->faker->url,
            'duration' => $this->faker->randomNumber(3),
            'serial_episode_id' => SerialEpisode::query()->inRandomOrder()->first()->id,
        ];
    }
}
