<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use App\Models\SerialEpisodeSeason;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class SerialSeasonController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $context['serials_seasons'] = SerialEpisodeSeason::query()->paginate(10);
        $context['message'] = $request->get('message');

        return view('serials_seasons.index', $context);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('serials_seasons.create', ['serials' => Serial::query()->get()]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description_en' => ['required', 'string', 'max:255'],
            'description_ru' => ['required', 'string', 'max:255'],
            'season_number' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'is_final' => ['required', 'boolean'],
            'serial_id' => ['required', Rule::exists(Serial::class, 'id')],
        ]);

        SerialEpisodeSeason::query()->create($request->all() + [
                'rate' => 0,
                'description' => [
                    'en' => $request->get('description_en'),
                    'ru' => $request->get('description_ru'),
                ]
            ]);

        return redirect()->route('serials_seasons.index', ['message' => __('dashboard.season.message.created')]);
    }

    /**
     * @param SerialEpisodeSeason $serialsSeason
     * @return Application|Factory|View
     */
    public function show(SerialEpisodeSeason $serialsSeason): Application|Factory|View
    {
        $serialsSeason->load(['serial']);

        return view('serials_seasons.show', ['serialSeason' => $serialsSeason]);
    }

    /**
     * @param SerialEpisodeSeason $serialsSeason
     * @return Application|Factory|View
     */
    public function edit(SerialEpisodeSeason $serialsSeason): Application|Factory|View
    {
        return view('serials_seasons.edit', [
            'serialSeason' => $serialsSeason,
            'serials' => Serial::query()->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param SerialEpisodeSeason $serialsSeason
     * @return RedirectResponse
     */
    public function update(Request $request, SerialEpisodeSeason $serialsSeason): RedirectResponse
    {
        $request->validate([
            'description_en' => ['required', 'string', 'max:255'],
            'description_ru' => ['required', 'string', 'max:255'],
            'season_number' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'is_final' => ['required', 'boolean'],
            'serial_id' => ['required', Rule::exists(Serial::class, 'id')],
        ]);

        $serialsSeason->update($request->all() + [
                'description' => [
                    'en' => $request->get('description_en'),
                    'ru' => $request->get('description_ru'),
                ]
            ]);

        return redirect()->route('serials_seasons.index', ['message' => __('dashboard.season.message.updated')]);
    }

    /**
     * @param SerialEpisodeSeason $serialsSeason
     * @return RedirectResponse
     */
    public function destroy(SerialEpisodeSeason $serialsSeason): RedirectResponse
    {
        $serialsSeason->delete();

        return redirect()->route('serials_seasons.index', ['message' => __('dashboard.season.message.deleted')]);
    }
}
