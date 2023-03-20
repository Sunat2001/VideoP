<?php

namespace App\Http\Controllers;

use App\Models\SerialEpisode;
use App\Models\SerialEpisodeSeason;
use App\Models\SerialEpisodeVideo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SerialEpisodeController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $context = [
            'serialEpisodes' => SerialEpisode::query()->paginate(10),
            'message' => $request->get('message'),
        ];

        return view('serial_episodes.index', $context);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $context['serials'] = SerialEpisode::query()->get();
        return view('serial_episodes.create', $context);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'serial_id' => 'required|integer',
            'season_id' => 'required|integer',
            'serial_number' => 'required|integer',
            'name_en' => 'required|string',
            'name_ru' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'trailer_url' => 'required|string',
        ]);

        SerialEpisode::query()->create([
            'serial_id' => $request->get('serial_id'),
            'season_id' => $request->get('season_id'),
            'serial_number' => $request->get('serial_number'),
            'rate' => 0,
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
            'description' => [
                'en' => $request->get('description_en'),
                'ru' => $request->get('description_ru'),
            ],
        ]);

        SerialEpisodeVideo::query()->create([
            'serial_episode_id' => SerialEpisode::query()->latest()->first()->id,
            'video_url' => $request->get('trailer_url'),
            'duration' => '5',
            'quality' => '720',
            'format' => 'mp4',
        ]);

        return redirect()->route('serials_episodes.index', ['message' => __('dashboard.episode.message.created')]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        $serialEpisode = SerialEpisode::query()->findOrFail($id);

        $serialEpisode->load(['serial', 'serialEpisodeVideos']);

        return view('serial_episodes.show', ['serialEpisode' => $serialEpisode]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Application|Factory|View
    {
        $serialEpisode = SerialEpisode::query()->findOrFail($id)->load(['serial', 'serialEpisodeVideos']);

        return view('serial_episodes.edit', [
            'serialEpisode' => $serialEpisode,
            'serials'       => SerialEpisode::query()->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'serial_id' => 'required|integer',
            'season_id' => 'required|integer',
            'serial_number' => 'required|integer',
            'name_en' => 'required|string',
            'name_ru' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'trailer_url' => 'required|string',
        ]);

        $serialEpisode = SerialEpisode::query()->findOrFail($id);

        $serialEpisode->update([
            'serial_id' => $request->get('serial_id'),
            'season_id' => $request->get('season_id'),
            'serial_number' => $request->get('serial_number'),
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
            'description' => [
                'en' => $request->get('description_en'),
                'ru' => $request->get('description_ru'),
            ],
        ]);

        $serialEpisode->serialEpisodeVideos()->update([
            'video_url' => $request->get('trailer_url'),
            'duration' => '5',
            'quality' => '720',
            'format' => 'mp4',
        ]);

        return redirect()->route('serials_episodes.index', ['message' => __('dashboard.episode.message.updated')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $serialEpisode = SerialEpisode::query()->findOrFail($id);

        $serialEpisode->delete();

        return redirect()->route('serials_episodes.index', ['message' => __('dashboard.episode.message.deleted')]);
    }
}
