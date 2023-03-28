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
    ){}

    public function perform(): void
    {
        $this->seedToDatabase();
    }

    private function seedToDatabase(): void
    {
        for ($i = 2; $i <= 2; $i++) {
            $this->saveSerialsWithSeasons($this->getSerials($i));
        }
    }

    private function saveSerialsWithSeasons(array $serials): void
    {
        foreach ($serials as $serial) {
            $serial = $this->saveSerial($serial);

            $serialDetailRu = $this->TMDBRepository->getSerialDetails($serial->external_id, 'ru');
            $serialDetailEn = $this->TMDBRepository->getSerialDetails($serial->external_id, 'en');


            $serial->update([
                'is_finished' => $serialDetailEn['status'] == 'Ended' ? 1 : 0,
            ]);

            foreach ($serialDetailRu['seasons'] as $key => $seasonRu) {
                $this->saveSeason($seasonRu, $serialDetailEn['seasons'][$key], $serial);
            }
        }
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
                'name' => [
                    'en' => $show['name'],
                    'ru' => $russianSerials['results'][$key]['name'],
                ],
                'description' => [
                    'en' => $show['overview'],
                    'ru' => $russianSerials['results'][$key]['overview'],
                ],
                'image_cover' => [
                    'en' => $imagePathEn,
                    'ru' => $imagePathRu,
                ],
                'rate' => $show['vote_average'],
                'external_id' => $show['id'],
                'external_resource' => ExternalSerialResources::TMDB,
                'created_at' => Carbon::now(),
            ];

            break;
        }

        return $serials;
    }

    private function savePoster(string $url, string $serial_id): string
    {
        $image = file_get_contents($url);
        $path = 'images/serials/' . $serial_id . '/' . now() . '.jpg';
        $publicPath = 'storage/' . $path;
        Storage::put($path, $image);

        return $publicPath;
    }

    private function saveSerial(array $serial): Serial
    {
        return Serial::query()->create($serial);
    }

    private function saveSeason(array $seasonRu, array $seasonEn, Serial $serial): void
    {
        $serial->serialEpisodeSeasons()->create([
            'season_number' => $seasonEn['season_number'],
            'description' => [
                'en' => $seasonEn['overview'],
                'ru' => $seasonRu['overview'],
            ],
            'rate' => 0,
            'external_id' => $seasonEn['id'],
            'year' => date("Y", strtotime($seasonEn['air_date'])),
        ]);

//        $this->saveEpisodes($seasonRu, $seasonEn, $season);
    }
}
