<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttributeValue>
 */
class AttributeValueFactory extends Factory
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
            'is_active' => $this->faker->boolean,
            'attribute_id' => Attribute::query()->inRandomOrder()->first()->id,
        ];
    }
}
