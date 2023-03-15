<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $context['message'] = $request->get('message');

        return view('attribute-values.index', $context);
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
     * @param AttributeValue $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param AttributeValue $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeValue $attributeValue)
    {
        //
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
