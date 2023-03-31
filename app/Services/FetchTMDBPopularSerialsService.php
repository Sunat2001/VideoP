<?php

namespace App\Services;

use App\Enum\ExternalSerialResources;
use App\Enum\Languages;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Serial;
use App\Models\SerialEpisodeSeason;
use App\Repositories\TMDBRepository;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FetchTMDBPopularSerialsService
{
    private Command $command;

    public function __construct(
        protected TMDBRepository $TMDBRepository,
    )
    {
    }

    public function perform(Command $command): void
    {
        $this->command = $command;
        $this->seedToDatabase();
    }

    private function seedToDatabase(): void
    {
        for ($i = 3; $i <= 10; $i++) {
            $this->saveSerialsWithSeasons($this->getSerials($i));
            $this->command->info('Page ' . $i . ' done');
            break;
        }
    }

    private function saveSerialsWithSeasons(array $serials): void
    {
        foreach ($serials as $serial) {
            $serial = $this->saveSerial($serial);
            $this->command->info('Serial ' . $serial->name . ' done');

            $serialDetailRu = $this->TMDBRepository->getSerialDetails($serial->external_id, Languages::RU);
            $serialDetailEn = $this->TMDBRepository->getSerialDetails($serial->external_id, Languages::EN);

            $this->getAttributes($serial, $serialDetailRu, $serialDetailEn);
            dd('here');

            $this->saveTrailer($serial);

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
        $englishSerials = $this->TMDBRepository->getPopularSerials(Languages::EN, $page);

        // Получаем список популярных сериалов на русском языке
        $russianSerials = $this->TMDBRepository->getPopularSerials(Languages::RU, $page);


        $serials = array();
        foreach ($englishSerials['results'] as $key => $show) {
            if ($russianSerials['results'][$key]['overview'] == '') {
                continue;
            }

//            $imagePathEn = $this->savePoster($this->TMDBRepository->getImagePath(
//                $show['poster_path']), $show['name']);
//            $imagePathRu = $this->savePoster($this->TMDBRepository->getImagePath(
//                $russianSerials['results'][$key]['poster_path']), $russianSerials['results'][$key]['name']);

            $imagePathEn = $this->TMDBRepository->getImagePath($show['poster_path']);
            $imagePathRu = $this->TMDBRepository->getImagePath($russianSerials['results'][$key]['poster_path']);

            $serials[] = [
                'name' => [
                    Languages::EN => $show['name'],
                    Languages::RU => $russianSerials['results'][$key]['name'],
                ],
                'description' => [
                    Languages::EN => $show['overview'],
                    Languages::RU => $russianSerials['results'][$key]['overview'],
                ],
                'image_cover' => [
                    Languages::EN => $imagePathEn,
                    Languages::RU => $imagePathRu,
                ],
                'rate' => $show['vote_average'],
                'external_id' => $show['id'],
                'external_resource' => ExternalSerialResources::TMDB,
            ];

            break;
        }

        return $serials;
    }

    private function getEpisodes(int $serial_id, array $seasonRu, array $seasonEn): array
    {
        $episodesRu = [];
        $episodesEn = [];

        for ($i = 1; $i <= $seasonRu['episode_count']; $i++) {
            $episodesRu[] = $this->TMDBRepository->getSerialEpisodeDetails($serial_id, $seasonRu['season_number'], $i, Languages::RU);
            $episodesEn[] = $this->TMDBRepository->getSerialEpisodeDetails($serial_id, $seasonEn['season_number'], $i, Languages::EN);
        }
        return [
            'episodes_ru' => $episodesRu,
            'episodes_en' => $episodesEn,
        ];
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
        $season = $serial->serialEpisodeSeasons()->create([
            'season_number' => $seasonEn['season_number'],
            'description' => [
                Languages::EN => $seasonEn['overview'],
                Languages::RU => $seasonRu['overview'],
            ],
            'rate' => 0,
            'external_id' => $seasonEn['id'],
            'year' => date("Y", strtotime($seasonEn['air_date'])),
        ]);

        $this->command->info('Season ' . $season->season_number . ' done');

        $this->saveEpisodes($seasonRu, $seasonEn, $season);
    }

    private function saveEpisodes(array $seasonRu, array $seasonEn, SerialEpisodeSeason|Model $season): void
    {
        $episodes = $this->getEpisodes($season->serial->external_id, $seasonRu, $seasonEn);
        foreach ($episodes['episodes_en'] as $key => $episodeEn) {
            $season->serialEpisodes()->create([
                'episode_number' => $episodeEn['episode_number'],
                'name' => [
                    Languages::EN => $episodeEn['name'],
                    Languages::RU => $episodes['episodes_ru'][$key]['name'],
                ],
                'description' => [
                    Languages::EN => $episodeEn['overview'],
                    Languages::RU => $episodes['episodes_ru'][$key]['overview'],
                ],
                'rate' => $episodeEn['vote_average'],
                'serial_id' => $season->serial->id,
                'season_id' => $season->id,
            ]);

            $this->command->info('Episode ' . $episodeEn['episode_number'] . ' done');
        }
    }

    private function saveTrailer(Serial $serial): void
    {
        $videos = $this->TMDBRepository->getSerialVideos($serial->external_id, Languages::EN);

        foreach ($videos['results'] as $video) {
            if ($video['type'] == 'Trailer' && $video['site'] == 'YouTube') {
                $serial->update([
                    'trailer' => "https://www.youtube.com/watch?v={$video['key']}",
                ]);
                break;
            }
        }
    }

    private function getAttributes(Serial $serial, array $serialRu, array $serialEn): void
    {
        $genresRU = $serialRu['genres'];
        $genresEN = $serialEn['genres'];

        $production_countriesRU = $serialRu['production_countries'];
        $production_countriesEN = $serialEn['production_countries'];

        $production_companiesRU = $serialRu['production_companies'];
        $production_companiesEN = $serialEn['production_companies'];

        $networksRU = $serialRu['networks'];
        $networksEN = $serialEn['networks'];

        $this->saveAttributes($genresRU, $genresEN, $serial, 'Genre');

        $this->command->info('Genres synced');

        $this->saveAttributes($production_countriesRU, $production_countriesEN, $serial, 'Country');

        $this->command->info('Countries synced');

        $this->saveAttributes($production_companiesRU, $production_companiesEN, $serial, 'Production company');

        $this->command->info('Production companies synced');

        $this->saveAttributes($networksRU, $networksEN, $serial, 'Network');

        $this->command->info('Networks synced');
    }

    private function saveAttributes(array $attributesRu, array $attributesEn, Serial $serial, string $attributeKey): void
    {
        $attributeId = Attribute::query()->where('name->en', $attributeKey)->first()->id;

        foreach ($attributesEn as $key => $attribute) {
            $attributeValue = AttributeValue::query()
                ->where('name->en', $attribute['name'])
                ->where('attribute_id', $attributeId)
                ->first();

            if (!$attributeValue) {
                $attributeValue = AttributeValue::query()->create([
                    'attribute_id' => $attributeId,
                    'name' => [
                        Languages::EN => $attribute['name'],
                        Languages::RU => $attributesRu[$key]['name'],
                    ],
                    'is_active' => true,
                ]);
            }

            $serial->attributeValues()->attach($attributeValue->id);
        }
    }

}
