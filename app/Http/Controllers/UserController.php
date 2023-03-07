<?php

namespace App\Http\Controllers;

use App\Enum\Languages;
use App\Http\Requests\Dashboard\UserStoreRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $context = [];
        $context['message'] = $request->get('message');
        $context['users'] = User::query()->paginate(10);

        return view('users.index', $context);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function show(User $user): Factory|View|Application
    {
        $context = [];
        $context['message'] = null;
        $context['user'] = $user->load('reviews.serial');

        return view('users.show', $context);
    }

    /**
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);
            $img = $request->file('image')->store('avatars/' . $request->user()->id, 'public');
        }

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $img ?? null,
            'is_admin' => $request->is_admin === 'on' ? true : false,
            'language' => $request->language,
        ]);

        return redirect()->route('users.index', ['message' => __('dashboard.user.message.created')]);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function edit(User $user): Factory|View|Application
    {
        $context = [];
        $context['message'] = null;
        $context['user'] = $user;

        return view('users.edit', $context);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function update(User $user): Factory|View|Application
    {
        $context = [];
        $context['message'] = null;
        $context['user'] = $user;

        return view('users.update', $context);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index', ['message' => __('dashboard.user.message.deleted')]);
    }
}
