<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    protected array $relations = [
        'serialEpisodes',
        'serialEpisodeSeasons',
        'attributeValues',
        'reviews',
    ];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $context = [];
        $context['serials'] = Serial::query()->withCount($this->relations)->paginate(10);
        $context['message'] = $request->get('message');

        return view('serials.index', $context);
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
     * @param Serial $serial
     * @return Application|Factory|View
     */
    public function show(Serial $serial): View|Factory|Application
    {
        $serial->load($this->relations)->loadCount($this->relations);

        return view('serials.show', compact('serial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
