<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $context['values'] = AttributeValue::query()->paginate(10);
        $context['attributes'] = Attribute::all();
        $context['message'] = $request->get('message');

        return view('attribute-values.index', $context);
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
            'attribute_id' => ['required', 'integer', Rule::exists(Attribute::class, 'id')],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        AttributeValue::query()->create([
            'name' => [
                'en' => $request->get('name_en'),
                'ru' => $request->get('name_ru'),
            ],
            'attribute_id' => $request->get('attribute_id'),
            'is_active' => true,
            'image' => $request->file('image') ? $request->file('image')->store('attribute-values') : null,
        ]);

        return redirect()->route('attribute-values.index', ['message' => __('dashboard.attribute_value.message.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param AttributeValue $attributeValue
     * @return Application|Factory|View
     */
    public function show(AttributeValue $attributeValue): Application|Factory|View
    {
        return view('attribute-values.show', ['attribute_value' => $attributeValue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param AttributeValue $attributeValue
     * @return Application|Factory|View
     */
    public function edit(Request $request, AttributeValue $attributeValue): Application|Factory|View
    {
        $context['attributes'] = Attribute::all();
        $context['attribute_value'] = $attributeValue;
        $context['message'] = $request->get('message');

        return view('attribute-values.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AttributeValue $attributeValue
     * @return RedirectResponse
     */
    public function update(Request $request, AttributeValue $attributeValue): RedirectResponse
    {
        $request->validate([
            'name_en' => ['nullable', 'string', 'max:255'],
            'name_ru' => ['nullable', 'string', 'max:255'],
            'attribute_id' => ['nullable', 'integer', Rule::exists(Attribute::class, 'id')],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        $attributeValue->update([
            'name' => [
                'en' => $request->get('name_en') ?? $attributeValue->name['en'],
                'ru' => $request->get('name_ru') ?? $attributeValue->name['ru']
            ],
            'attribute_id' => $request->get('attribute_id') ?? $attributeValue->attribute_id,
            'image' => $request->file('image') ? $request->file('image')->store('attribute-values') : $attributeValue->image,
        ]);

        return redirect()->route('attribute-values.edit', [
            'attribute_value' => $attributeValue,
            'message' => __('dashboard.attribute_value.message.updated')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AttributeValue $attributeValue
     * @return RedirectResponse
     */
    public function destroy(AttributeValue $attributeValue): RedirectResponse
    {
        $attributeValue->delete();

        return redirect()->route('attribute-values.index', ['message' => __('dashboard.attribute_value.message.deleted')]);
    }

    public function changeActive(AttributeValue $attributeValue): RedirectResponse
    {
        $attributeValue->is_active = !$attributeValue->is_active;
        $attributeValue->save();

        return redirect()->route('attribute-values.index', ['message' => __('dashboard.attribute_value.message.updated')]);
    }
}
