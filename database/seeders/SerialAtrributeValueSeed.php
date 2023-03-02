<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerialAtrributeValueSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 1,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 83,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 25,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 26,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 78,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 79,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 92,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 95,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 33,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 110,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 162,
        ]);

        DB::table('serial_attribute_value')->insert([
            'serial_id' => 1,
            'attribute_value_id' => 219,
        ]);

    }
}
