<?php

namespace App\Services;

use App\Models\Serial;
use App\Repositories\TMDBRepository;
use Illuminate\Support\Collection;

class FetchTMDBPopularSerialsService
{
    public function __construct(
        protected TMDBRepository $TMDBRepository,
    )
    {
    }

    public function perform(): void
    {
        $this->seedToDatabase();
    }

    private function seedToDatabase(): void
    {
        // Получаем список популярных сериалов
        $serials = $this->getSerials(1);

        // Сохраняем сериалы в базу данных
        $this->saveSerials($serials);
    }

    private function saveSerials(array $serials): void
    {
        // Сохраняем сериалы в базу данных
        Serial::query()->insert($serials);

//            // Создаем новый сезон
//            $newSeason = new SerialEpisodeSeason();
//            $newSeason->serial_id = $newSerial->id;
//            $newSeason->season_number = 1;
//            $newSeason->save();

    }

    private function getSerials(int $page): array
    {
        // Получаем список популярных сериалов на английском языке
        $englishSerials = $this->TMDBRepository->getPopularSerials('en', $page);

        // Получаем список популярных сериалов на русском языке
        $russianSerials = $this->TMDBRepository->getPopularSerials('ru', $page);


        // Объединяем списки сериалов по ID
        $serials = array();
        foreach ($englishSerials['results'] as $key => $show) {
            if ($russianSerials['results'][$key]['overview'] == '') {
                continue;
            }

            $imagePath = $this->savePoster($this->TMDBRepository->getImagePath($show['poster_path'], 'w500'), $show['name']);

            $serials[] = [
                'name' => [
                    'en' => $show['name'],
                    'ru' => $russianSerials['results'][$key]['name'],
                ],
                'description' => [
                    'en' => $show['overview'],
                    'ru' => $russianSerials['results'][$key]['overview'],
                ],
                'image_cover' => $imagePath,
                'rate' => $show['vote_average'],
            ];

            break;
        }

        return $serials;
    }

    private function getSerialsWithSeason(): Collection
    {
        // Получаем список популярных сериалов на английском языке
        $englishSerials = $this->tvRepository->getPopular(['language' => 'en']);

        // Получаем список популярных сериалов на русском языке
        $russianSerials = $this->tvRepository->getPopular(['language' => 'ru']);

        // Объединяем списки сериалов по ID
        $serials = collect($englishSerials)->merge(collect($russianSerials))
            ->unique('id')->values()->all();

        // Получаем дополнительную информацию о каждом сериале
        $this->tvRepository->load($serials, [
            'translations',
            'credits',
            'images',
            'videos',
            'keywords',
            'seasons',
        ]);

        // Получаем поля каждого сериала, которые нам нужны
        $serialsData = collect($serials)->map(function ($serial) {
            $seasonsData = collect($serial->getSeasons())->map(function ($season) use ($serial) {
                return [
                    'season_number' => $season->getSeasonNumber(),
                    'air_date' => $season->getAirDate(),
                    'overview' => $season->getOverview(),
                    'poster' => $season->getPosterImage()->getUrl(),
                    'rating' => $season->getVoteAverage(),
                    'is_final_season' => $season->getSeasonNumber() == $serial->getNumberOfSeasons(),
                ];
            });

            return [
                'name' => $serial->getName(),
                'description' => $serial->getOverview(),
                'poster' => $serial->getPosterImage()->getUrl(),
                'rating' => $serial->getVoteAverage(),
                'seasons' => $seasonsData,
            ];
        });

        return $serialsData;
    }

    private function savePoster(string $url, string $serial_id): string
    {
        $image = file_get_contents($url);
        $imageName = $serial_id . '/' . time() . '.jpg';
        $path = public_path('storage/images/serials/' . $imageName);
        file_put_contents($path, $image);

        return $imageName;
    }
}
