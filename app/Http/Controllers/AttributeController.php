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
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('attributes.create');
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
     * @param Attribute $attribute
     * @return Application|Factory|View
     */
    public function edit(Attribute $attribute): Application|Factory|View
    {
        return view('attributes.edit', ['attribute' => $attribute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
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
