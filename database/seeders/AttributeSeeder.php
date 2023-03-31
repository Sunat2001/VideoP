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
                    'en' => 'Year of production',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Страна',
                    'en' => 'Country',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Жанр',
                    'en' => 'Genre',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Режиссер',
                    'en' => 'Director',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Сценарий',
                    'en' => 'Screenplay',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Продюсер',
                    'en' => 'Producer',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'В главных ролях',
                    'en' => 'Starring',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Композитор',
                    'en' => 'Composer',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Художник',
                    'en' => 'Art Director',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Монтаж',
                    'en' => 'Editor',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Возраст',
                    'en' => 'Age',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Субтитры',
                    'en' => 'Subtitles',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Аудиодорожки',
                    'en' => 'Audio tracks',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'ru' => 'Качество видео',
                    'en' => 'Video quality',
                ],
                'is_active' => true,
            ],

            [
                'name' => [
                    'en' => 'Network',
                    'ru' => 'Сеть',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Production company',
                    'ru' => 'Продюсерская компания',
                ],
                'is_active' => true,
            ]
        ];

//        Attribute::query()->insert($attributes);
        foreach ($attributes as $attribute) {
            Attribute::query()->create($attribute);
        }
    }
}
