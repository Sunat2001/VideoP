<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 22; $i++) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => '20' . str_pad($i, 2, '0', STR_PAD_LEFT),
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Год производства')->id,
            ]);
        }

        $this->command->info('Attribute values for "Год производства" created');

        $countries = [
            'США',
            'Великобритания',
            'Германия',
            'Франция',
            'Италия',
            'Япония',
            'Канада',
            'Испания',
            'Швеция',
            'Южная Корея',
            'Австралия',
            'Нидерланды',
            'Индия',
            'Бельгия',
            'Швейцария',
            'Израиль',
            'Австрия',
            'Дания',
            'Норвегия',
            'Ирландия',
            'Польша',
            'Турция',
            'Россия',
            'Греция',
            'Чехия',
            'Хорватия',
            'Бразилия',
            'Сингапур',
            'Мексика',
            'Сербия',
            'Украина',
            'Израиль',
            'Швейцария',
            'Россия',
            ];

        foreach ($countries as $country) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $country,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Страна')->id,
            ]);
        }

        $this->command->info('Attribute values for "Страна" created');

        $genres = [
            'Боевик',
            'Вестерн',
            'Военный',
            'Детектив',
            'Детский',
            'Документальный',
            'Драма',
            'Исторический',
            'Комедия',
            'Криминал',
            'Мелодрама',
            'Мистика',
            'Музыка',
            'Мультфильм',
            'Приключения',
            'Семейный',
            'Спорт',
            'Триллер',
            'Ужасы',
            'Фантастика',
            'Фэнтези',
            'Другое',
        ];

        foreach ($genres as $genre) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $genre,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Жанр')->id,
            ]);
        }

        $this->command->info('Attribute values for "Жанр" created');

        $directors = [
            "Стивен Спилберг", "Квентин Тарантино", "Мартин Скорсезе", "Уилл Смит", "Кристофер Нолан", "Дэвид Финчер",
            "Френсис Форд Коппола", "Джеймс Кэмерон", "Роджер Аллерс", "Питер Джексон", "Тим Бёртон", "Дэнни Бойл",
            "Ридли Скотт", "Стэнли Кубрик", "Клинт Иствуд", "Пол Томас Андерсон", "Спайк Джонз", "Мишель Гондри",
            "Джон Карпентер", "Терренс Малик", "Гас Ван Сантен", "Джон Малкович", "Бертран Тавенадо", "Дэвид Линч",
            "Джонни Депп",  "Пол Верховен", "Роман Полански", "Уэс Андерсон", "Вонг Кар Вай", "Рон Ховард"
        ];

        foreach ($directors as $director) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $director,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Режиссер')->id,
            ]);
        }

        $this->command->info('Attribute values for "Режиссер" created');

        $producers = [
            "Джерри Брукхаймер",
            "Джон Лассетер",
            "Джон Линдсей",
            "Майкл Бэй",
            "Джеймс Ван",
            "Тайлер Перри",
            "Сергей Безруков",
            "Джейсон Р. Блум",
            "Кристофер Нолан",
            "Мартин Скорсезе",
            "Дэвид Финчер",
            "Квентин Тарантино",
            "Джордж Лукас",
            "Джеймс Кэмерон",
            "Петер Джаксон",
            "Стивен Спилберг",
            "Ридли Скотт",
            "Роджер Аллерс",
            "Дэнни Бойл",
            "Джон Форд",
            "Джеймс Манголд",
            "Мэл Гипсон",
            "Роберт Земекис",
            "Стивен Добкин",
            "Тим Бёртон",
            "Кристофер Уокен",
            "Ричард Линклейтер",
            "Дэвид Линч",
            "Роман Полански",
            "Рон Ховард",
            "Роберт Редфорд",
            "Уолтер Хэллэр",
            "Джон Майерс",
            "Дэвид О. Расселл"
        ];

        foreach ($producers as $producer) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $producer,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Продюсер')->id,
            ]);
        }

        $this->command->info('Attribute values for "Продюсер" created');

        $actors = [
            "Марлон Брандо",
            "Аль Пачино",
            "Марlon Брандо",
            "Джеймс Дейн",
            "Роберт Де Ниро",
            "Майкл Кейн",
            "Дензел Вашингтон",
            "Леонардо ДиКаприо",
            "Джек Николсон",
            "Том Харди",
            "Дэнни ДеВито",
            "Роберт Редфорд",
            "Мэттью МакКонахи",
            "Джонни Депп",
            "Харрисон Форд",
            "Руперт Гринт",
            "Джон Траволта",
            "Роберт Дауни мл.",
            "Уилл Смит",
            "Рассел Кроу",
            "Роберт Паттинсон",
            "Джеймс Франко",
            "Брэд Питт",
            "Джонни Депп",
            "Джейсон Стэйтем",
            "Чад Хедер",
            "Джеймс Кэмерон",
            "Джош Бролин",
            "Роберт Де Ниро",
            "Джейсон Момоа",
            "Рассел Кроу",
            "Майкл Кейн",
            "Джош Дюамель",
            "Джон Траволта",
            "Мэттью МакКонахи",
            "Кейн Брана",
            "Джонни Депп",
            "Руперт Гринт",
            "Дензел Вашингтон",
            "Джон Гудман",
            ];

        foreach ($actors as $actor) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $actor,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'В главных ролях')->id,
            ]);
        }

        $this->command->info('Attribute values for "Актер" created');

        $composers = [
            "Джон Уилямс",
            "Ханс Циммер",
            "Джон Уилямс",
            "Джеймс Хорнер",
            "Дэнни Эльфман",
            "Эльмар Росс",
            "Джон Уилямс",
            "Джонни Гринуэлл",
            "Джеймс Ньютон Ховард",
            "Джон Уилямс",
            "Томас Нейлс",
            "Джонни Гринуэлл",
            "Дэнни Эльфман",
            "Джеймс Хорнер",
            "Ханс Циммер",
            "Джеймс Ньютон Ховард",
            "Джон Уилямс",
            "Джонни Марр",
            "Джеймс Хорнер",
            "Джонни Гринуэлл",
            "Джеймс Ньютон Ховард",
        ];

        foreach ($composers as $composer) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $composer,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Композитор')->id,
            ]);
        }

        $this->command->info('Attribute values for "Композитор" created');

        $filmEditors = [
            "Майкл Байдер",
            "Тед Росслер",
            "Уолтер Мартин",
            "Джон Уилямс",
            "Стивен Уиндер",
            "Ричард Франкенберг",
            "Джеймс Ньютон Ховард",
            "Джеймс Хорнер",
            "Джонни Гринуэлл",
            "Мартин Скорсезе",
            "Дэнни Эльфман",
            "Эльмар Росс",
            "Джеймс Ньютон Ховард",
            "Джон Уилямс",
            "Джонни Гринуэлл",
            "Томас Нейлс",
            "Джон Уилямс",
            "Джеймс Хорнер",
            "Ханс Циммер",
            "Дэнни Эльфман",
        ];

        foreach ($filmEditors as $filmEditor) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $filmEditor,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Монтаж')->id,
            ]);
        }

        $this->command->info('Attribute values for "Монтаж" created');

        for ($i = 1; $i <= 21; $i++) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $i,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Возраст')->id,
            ]);
        }

        $this->command->info('Attribute values for "Возраст" created');

        $videoQualityTitles = [
            "4K Ultra HD",
            "1080p Full HD",
            "720p HD",
            "480p Standard Definition",
            "360p Low Definition",
        ];

        foreach ($videoQualityTitles as $videoQualityTitle) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $videoQualityTitle,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Качество видео')->id,
            ]);
        }

        $this->command->info('Attribute values for "Качество видео" created');
    }
}
