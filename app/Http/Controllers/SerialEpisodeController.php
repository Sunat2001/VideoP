<?php

namespace App\Http\Controllers;

use App\Models\SerialEpisode;
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
        return view('serial_episodes.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param SerialEpisode $serialEpisode
     * @return Application|Factory|View
     */
    public function show(int $id): Application|Factory|View
    {
        $serialEpisode = SerialEpisode::query()->findOrFail($id);

        $serialEpisode->load(['serial', 'serialEpisodeVideos']);

        return view('serial_episodes.show', ['serialEpisode' => $serialEpisode]);
    }

    /**
     * @param SerialEpisode $serialEpisode
     * @return \Illuminate\Http\Response
     */
    public function edit(SerialEpisode $serialEpisode)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param SerialEpisode $serialEpisode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SerialEpisode $serialEpisode)
    {
        //
    }

    /**
     * @param SerialEpisode $serialEpisode
     * @return RedirectResponse
     */
    public function destroy(SerialEpisode $serialEpisode): RedirectResponse
    {
        $serialEpisode->delete();

        return redirect()->route('serials_episodes.index', ['message' => __('dashboard.episode.message.deleted')]);
    }
}
