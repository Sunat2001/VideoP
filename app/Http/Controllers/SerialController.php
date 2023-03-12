<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Serial;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SerialController extends Controller
{
    protected array $relations = [
        'serialEpisodes',
        'serialEpisodeSeasons',
        'attributeValues.attribute',
        'reviews',
    ];

    protected array $relationsForCount = [
        'serialEpisodes',
        'serialEpisodeSeasons',
    ];

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $context = [];
        $context['serials'] = Serial::query()->withCount($this->relationsForCount)->paginate(10);
        $context['message'] = $request->get('message');

        return view('serials.index', $context);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): Application|Factory|View
    {
        $context['message'] = $request->get('message');
        $context['attributes'] = Attribute::query()->with(['attributeValues'])->get();

        return view('serials.create', $context);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'image_cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'attributeValues' => ['required', 'array'],
            'attributeValues.*' => ['required', 'integer', Rule::exists(AttributeValue::class, 'id')],
        ]);

        try {
            $serial = Serial::query()->create([
                'name' => [
                    'en' => $request->get('name_en'),
                    'ru' => $request->get('name_ru'),
                ],
                'description' => [
                    'en' => $request->get('description_en'),
                    'ru' => $request->get('description_ru'),
                ],
                'image_cover' => $request->file('image_cover') ? $request->file('image_cover')->store('serials') : "https://via.placeholder.com/640x480.png/005544?text=ullam",
                'rate' => '0.0',
            ]);

            $serial->attributeValues()->sync($request->get('attributeValues'));
        } catch (Exception $exception) {
            return redirect()->route('serials.create', ['message' => $exception->getMessage()]);
        }

        return redirect()->route('serials.index', ['message' => __('dashboard.serial.message.created')]);
    }

    /**
     * @param Serial $serial
     * @return Application|Factory|View
     */
    public function show(Serial $serial): View|Factory|Application
    {
        $serial->load($this->relations);

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
            'description_ru' => 'required|string',
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

        return redirect()->route('serials.edit', [
            'serial' => $serial->id,
            'message', __('dashboard.serial.message.updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Serial $serial
     * @return RedirectResponse
     */
    public function destroy(Serial $serial): RedirectResponse
    {
        $serial->delete();

        return redirect()->route('serials.index', ['message' => __('dashboard.serial.message.deleted')]);
    }
}
