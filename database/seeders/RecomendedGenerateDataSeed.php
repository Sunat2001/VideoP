<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecomendedGenerateDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('user_episode_viewed')->insert([
            'user_id' => 1,
            'video_episode_id' => 1,
        ]);

        DB::table('user_episode_viewed')->insert([
            'user_id' => 1,
            'video_episode_id' => 2,
        ]);



        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 1,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 25,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 26,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 67,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 68,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 4,
            'attribute_value_id' => 69,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 14,
            'attribute_value_id' => 69,
        ]);

    }
}
