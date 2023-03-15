<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $context['attributes'] = Attribute::query()->paginate(10);
        $context['message'] = $request->get('message');

        return view('attributes.index', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
        ]);

        Attribute::query()->create([
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
            'is_active' => true,
        ]);

        return redirect()->route('attributes.index', ['message' => __('dashboard.attribute.message.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Attribute $attribute
     * @return Application|Factory|View
     */
    public function show(Attribute $attribute): View|Factory|Application
    {
        $attribute->load('attributeValues');

        return view('attributes.show', ['attribute' => $attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Attribute $attribute
     * @return Application|Factory|View
     */
    public function edit(Request $request, Attribute $attribute): Application|Factory|View
    {

        return view('attributes.edit', [
            'attribute' => $attribute,
            'message' => $request->get('message'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
        ]);

        $attribute->update([
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
        ]);

        return redirect()->route('attributes.edit', [
            'attribute' => $attribute,
            'message' => __('dashboard.attribute.message.updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function destroy(Attribute $attribute): RedirectResponse
    {
        $attribute->delete();

        return redirect()->route('attributes.index', ['message' => __('dashboard.attribute.message.deleted')]);
    }

    public function changeActive(Attribute $attribute)
    {
        $attribute->is_active = !$attribute->is_active;
        $attribute->save();

        return redirect()->route('attributes.index', ['message' => __('dashboard.attribute.message.attribute_changed')]);
    }
}
