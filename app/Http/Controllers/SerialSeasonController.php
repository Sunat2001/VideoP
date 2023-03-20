<?php

namespace App\Http\Controllers;

use App\Models\SerialEpisodeSeason;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SerialSeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $context['serials_seasons'] = SerialEpisodeSeason::query()->paginate(10);
        $context['message'] = $request->get('message');

        return view('serials_seasons.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SerialEpisodeSeason  $serialEpisodeSeason
     * @return Application|Factory|View
     */
    public function show(SerialEpisodeSeason $serialEpisodeSeason): Application|Factory|View
    {
        return view('serials_seasons.show', ['serials_season' => $serialEpisodeSeason]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SerialEpisodeSeason  $serialEpisodeSeason
     * @return \Illuminate\Http\Response
     */
    public function edit(SerialEpisodeSeason $serialEpisodeSeason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SerialEpisodeSeason  $serialEpisodeSeason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SerialEpisodeSeason $serialEpisodeSeason)
    {
        //
    }

    /**
     * @param SerialEpisodeSeason $serialsSeason
     * @return RedirectResponse
     */
    public function destroy(SerialEpisodeSeason $serialsSeason): \Illuminate\Http\RedirectResponse
    {
        $serialsSeason->delete();

        return redirect()->route('serials_seasons.index', ['message' => __('dashboard.season.message.deleted')]);
    }
}
