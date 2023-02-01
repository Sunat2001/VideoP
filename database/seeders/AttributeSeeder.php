<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'name' => [
                    'ru' => 'Год производства',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Страна',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Жанр',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Режиссер',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Сценарий',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Продюсер',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'В главных ролях',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Композитор',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Художник',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Монтаж',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Возраст',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Субтитры',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Аудиодорожки',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Качество видео',
                ],
                'is_active' => true,
            ],
        ];

//        Attribute::query()->insert($attributes);
        foreach ($attributes as $attribute) {
            Attribute::query()->create($attribute);
        }
    }
}
