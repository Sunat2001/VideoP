<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Http;

class TMDBRepository
{
    public function getPopularSerials(string $language, int $page = 1): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/popular', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language,
                'page' => $page
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }

    }

    public function getSerialDetails(int $id, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id, [
                'api_key' => config('services.tmdb.token'),
                'language' => $language,
                'append_to_response' => 'credits',
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialSeasonDetails(int $id, int $seasonNumber, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/season/' . $seasonNumber, [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialEpisodeDetails(int $id, int $seasonNumber, int $episodeNumber, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/season/' . $seasonNumber . '/episode/' . $episodeNumber, [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialCredits(int $id, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/credits', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialVideos(int $id, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/videos', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialImages(int $id, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/images', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialKeywords(int $id, string $language): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/keywords', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getSerialRecommendations(int $id, string $language, int $page = 1): array
    {
        try {
            return Http::withOptions([
                'verify' => false
            ])->get(config('services.tmdb.endpoint') . 'tv/' . $id . '/recommendations', [
                'api_key' => config('services.tmdb.token'),
                'language' => $language,
                'page' => $page
            ])->json();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function getImagePath(string $path, string $size = 'original'): string|null
    {
        return $path ? config('services.tmdb.image_url') . $size . $path : null;
    }
}
