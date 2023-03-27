<?php

namespace App\Services;

use App\Enum\ExternalSerialResources;
use App\Models\Serial;
use App\Repositories\TMDBRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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
        for ($i = 1; $i <= 10; $i++) {
            $this->saveSerials($this->getSerials($i));
        }
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

            $imagePathEn = $this->savePoster($this->TMDBRepository->getImagePath(
                $show['poster_path']), $show['name']);
            $imagePathRu = $this->savePoster($this->TMDBRepository->getImagePath(
                $russianSerials['results'][$key]['poster_path']), $russianSerials['results'][$key]['name']);

            $serials[] = [
                'name' => json_encode([
                    'en' => $show['name'],
                    'ru' => $russianSerials['results'][$key]['name'],
                ]),
                'description' => json_encode([
                    'en' => $show['overview'],
                    'ru' => $russianSerials['results'][$key]['overview'],
                ]),
                'image_cover' => json_encode([
                    'en' => $imagePathEn,
                    'ru' => $imagePathRu,
                ]),
                'rate' => $show['vote_average'],
                'external_id' => $show['id'],
                'external_resource' => ExternalSerialResources::TMDB,
                'created_at' => Carbon::now(),
            ];

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
        $path = 'images/serials/' . $serial_id . '/' . now() . '.jpg';
        $publicPath = 'storage/' . $path;
        Storage::put($path, $image);

        return $publicPath;
    }
}
