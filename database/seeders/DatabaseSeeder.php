<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Review;
use App\Models\Serial;
use App\Models\SerialEpisode;
use App\Models\SerialEpisodeSeason;
use App\Models\SerialEpisodeVideo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->call([
            AttributeSeeder::class,
            AttributeValueSeeder::class,
        ]);

        Serial::factory(30)->create();
        SerialEpisodeSeason::factory(30)->create();
        SerialEpisode::factory(30)->create();
        SerialEpisodeVideo::factory(30)->create();

        Review::factory(5)->create();
    }
}
