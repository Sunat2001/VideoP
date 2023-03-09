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
            'United States' => 'США',
            'United Kingdom' => 'Великобритания',
            'Germany' => 'Германия',
            'France' => 'Франция',
            'Italy' => 'Италия',
            'Japan' => 'Япония',
            'Canada' => 'Канада',
            'Spain' => 'Испания',
            'Sweden' => 'Швеция',
            'South Korea' => 'Южная Корея',
            'Australia' => 'Австралия',
            'Netherlands' => 'Нидерланды',
            'India' => 'Индия',
            'Belgium' => 'Бельгия',
            'Switzerland' => 'Швейцария',
            'China' => 'Китай',
            'Hong Kong' => 'Гонконг',
            'Ireland' => 'Ирландия',
            'Denmark' => 'Дания',
            'Norway' => 'Норвегия',
            'Poland' => 'Польша',
            'Turkey' => 'Турция',
            'Russia' => 'Россия',
            'Greece' => 'Греция',
            'Czech Republic' => 'Чехия',
            'Croatia' => 'Хорватия',
            'Brazil' => 'Бразилия',
            'Singapore' => 'Сингапур',
            'Mexico' => 'Мексика',
            'Serbia' => 'Сербия',
            'New Zealand' => 'Новая Зеландия',
            'Austria' => 'Австрия',
            'Finland' => 'Финляндия',
            'Argentina' => 'Аргентина',
            ];

        foreach ($countries as $countryEn => $country) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $country,
                    'en' => $countryEn,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Страна')->id,
            ]);
        }

        $this->command->info('Attribute values for "Страна" created');

        $genres = [
            'Action' => 'Боевик',
            'Adventure' => 'Приключения',
            'Animation' => 'Мультфильм',
            'Biography' => 'Биография',
            'Comedy' => 'Комедия',
            'Crime' => 'Криминал',
            'Documentary' => 'Документальный',
            'Drama' => 'Драма',
            'Family' => 'Семейный',
            'Fantasy' => 'Фэнтези',
            'Film-Noir' => 'Фильм-нуар',
            'History' => 'История',
            'Horror' => 'Ужасы',
            'Music' => 'Музыка',
            'Musical' => 'Мюзикл',
            'Mystery' => 'Детектив',
            'Romance' => 'Мелодрама',
            'Sci-Fi' => 'Фантастика',
            'Sport' => 'Спорт',
            'Thriller' => 'Триллер',
            'War' => 'Военный',
            'Western' => 'Вестерн',
            'Short' => 'Короткометражка',
            'Adult' => 'Для взрослых',
            'Talk-Show' => 'Ток-шоу',
            'Game-Show' => 'Игровой шоу',
            'Reality-TV' => 'Реалити-шоу',
            'News' => 'Новости',
        ];

        foreach ($genres as $genreEn => $genre) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $genre,
                    'en' => $genreEn,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Жанр')->id,
            ]);
        }

        $this->command->info('Attribute values for "Жанр" created');

        $directors = [
            "Steven Spielberg" => "Стивен Спилберг",
            "Martin Scorsese" => "Мартин Скорсезе",
            "Quentin Tarantino" => "Квентин Тарантино",
            "Stanley Kubrick" => "Стэнли Кубрик",
            "Alfred Hitchcock" => "Альфред Хичкок",
            "Woody Allen" => "Ууди Аллен",
            "Akira Kurosawa" => "Акира Куросава",
            "Francis Ford Coppola" => "Фрэнсис Форд Коппола",
            "Orson Welles" => "Орсон Уэллес",
            "Federico Fellini" => "Федерико Феллини",
            "Sergio Leone" => "Серджио Леоне",
            "Billy Wilder" => "Билли Уайлдер",
            "Clint Eastwood" => "Клинт Иствуд",
            "Ingmar Bergman" => "Ингмар Бергман",
            "Luchino Visconti" => "Лучино Висконти",
            "John Ford" => "Джон Форд",
            "Charles Chaplin" => "Чарльз Чаплин",
            "David Lean" => "Дэвид Лин",
            "Robert Bresson" => "Робер Брессон",
            "Jean-Luc Godard" => "Жан-Люк Годар",
            "Rainer Werner Fassbinder" => "Райнер Вернер Фассбиндер",
            "Satyajit Ray" => "Сатяджит Рей",
            "Jean Renoir" => "Жан Рено",
            "Fritz Lang" => "Фриц Ланг",
            "Alain Resnais" => "Алан Резна",
            "Erich von Stroheim" => "Эрих фон Штройхайм",
            "D.W. Griffith" => "Д.В. Гриффит",
            "Michael Curtiz" => "Майкл Кертиц",
            "John Huston" => "Джон Хастон",
            "Joseph L. Mankiewicz" => "Джозеф Л. Манкиевич",
            "George Cukor" => "Джордж Кукор",
            "William Wyler" => "Уильям Уайлер",
            "William Wellman" => "Уильям Уэллман",
            "Howard Hawks" => "Говард Хокс",
        ];

        foreach ($directors as $directorEn => $director) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $director,
                    'en' => $directorEn,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Режиссер')->id,
            ]);
        }

        $this->command->info('Attribute values for "Режиссер" created');

        $producers = [
            "Jerry Bruckheimer" => "Джерри Брукхаймер",
            "Joel Silver" => "Джоэл Сильвер",
            "Robert Evans" => "Роберт Эванс",
            "Dino De Laurentiis" => "Дино Де Лоранти",
            "Irwin Winkler" => "Ирвин Уинклер",
            "David Brown" => "Дэвид Браун",
            "Robert Chartoff" => "Роберт Чартофф",
            "Irwin Allen" => "Ирвин Аллен",
            "Robert Zemeckis" => "Роберт Земекис",
            "Michael Douglas" => "Майкл Дуглас",
            "Robert Redford" => "Роберт Редфорд",
            "Steven Spielberg" => "Стивен Спилберг",
            "Martin Scorsese" => "Мартин Скорсезе",
            "Quentin Tarantino" => "Квентин Тарантино",
            "Stanley Kubrick" => "Стэнли Кубрик",
            "Alfred Hitchcock" => "Альфред Хичкок",
            "Woody Allen" => "Ууди Аллен",
            "Akira Kurosawa" => "Акира Куросава",
            "Francis Ford Coppola" => "Фрэнсис Форд Коппола",
            "Orson Welles" => "Орсон Уэллес",
            "Federico Fellini" => "Федерико Феллини",
            "Sergio Leone" => "Серджио Леоне",
            "Billy Wilder" => "Билли Уайлдер",
            "Clint Eastwood" => "Клинт Иствуд",
            "Ingmar Bergman" => "Ингмар Бергман",
            "Luchino Visconti" => "Лучино Висконти",
            "John Ford" => "Джон Форд",
            "Charles Chaplin" => "Чарльз Чаплин",
            "David Lean" => "Дэвид Лин",
            "Robert Bresson" => "Робер Брессон",
            "Jean-Luc Godard" => "Жан-Люк Годар",
            "Rainer Werner Fassbinder" => "Райнер Вернер Фассбиндер",
            "Satyajit Ray" => "Сатяджит Рей",
            "Jean Renoir" => "Жан Рено",
            "Fritz Lang" => "Фриц Ланг",
            "Alain Resnais" => "Алан Резна",
            "Erich von Stroheim" => "Эрих фон Штройхайм",
            "D.W. Griffith" => "Д.В. Гриффит",
            "Michael Curtiz" => "Майкл Кертиц",
            "John Huston" => "Джон Хастон",
            "Joseph L. Mankiewicz" => "Джозеф Л. Манкиевич",
            "George Cukor" => "Джордж Кукор",
            "William Wyler" => "Уильям Уайлер",
            "William Wellman" => "Уильям Уэллман",
            "Howard Hawks" => "Говард Хокс",
        ];

        foreach ($producers as $producerEn => $producer) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $producer,
                    'en' => $producerEn,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Продюсер')->id,
            ]);
        }

        $this->command->info('Attribute values for "Продюсер" created');

        $actors = [
            "Marlon Brando" => "Марлон Брандо",
            "Al Pacino" => "Аль Пачино",
            "Robert De Niro" => "Роберт Де Ниро",
            "Dustin Hoffman" => "Дастин Хоффман",
            "Jack Nicholson" => "Джек Николсон",
            "Robert Duvall" => "Роберт Дувалл",
            "Tom Hanks" => "Том Хэнкс",
            "Daniel Day-Lewis" => "Дэниэл Дэй-Льюис",
            "Denzel Washington" => "Дензел Уэшингтон",
            "Sean Penn" => "Сеан Пенн",
            "Anthony Hopkins" => "Энтони Хопкинс",
            "Morgan Freeman" => "Морган Фримен",
            "Jack Lemmon" => "Джек Леммон",
            ];

        foreach ($actors as $actorEn => $actor) {
            AttributeValue::query()->create([
                'name' => [
                    'ru' => $actor,
                    'en' => $actorEn,
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
                    'en' => $composer,
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
                    'en' => $filmEditor,
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
                    'en' => $i,
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
                    'en' => $videoQualityTitle,
                ],
                'is_active' => true,
                'attribute_id' => Attribute::query()->firstWhere('name->ru', 'Качество видео')->id,
            ]);
        }

        $this->command->info('Attribute values for "Качество видео" created');
    }
}
