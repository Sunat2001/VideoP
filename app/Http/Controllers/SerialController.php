<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param Serial $serial
     * @return Application|Factory|View
     */
    public function show(Serial $serial): View|Factory|Application
    {
        $serial->load($this->relations)->loadCount($this->relations);

        return view('serials.show', compact('serial'));
    }

    /**
     * @param Request $request
     * @param Serial $serial
     * @return Application|Factory|View
     */
    public function edit(Request $request, Serial $serial): View|Factory|Application
    {
        $context['serial'] = $serial->load($this->relations);
        $context['message'] = $request->get('message');

        return view('serials.edit', $context);
    }

    /**
     * @param Request $request
     * @param Serial $serial
     * @return RedirectResponse
     */
    public function update(Request $request, Serial $serial): RedirectResponse
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ru' => 'required|string',
            'description_en' => 'required|string',
            'description' => 'required|string',
            'image_cover' => 'nullable|image',
        ]);

        $serial->update([
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
            'description' => [
                'en' => $request->get('description_en'),
                'ru' => $request->get('description_ru'),
            ],
            'image_cover' => $request->file('image_cover') ? $request->file('image_cover')->store('serials') : $serial->image_cover,
        ]);

        return redirect()->route('serials.edit', $serial->id)->with('message', __('dashboard.serials.update'));
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
