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
use Illuminate\Support\Facades\Storage;
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
        $user->load('reviews.serial');

        return view('users.show', compact('user'));
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
            'is_admin' => $request->is_admin === 'on',
            'language' => $request->language,
        ]);

        return redirect()->route('users.index', ['message' => __('dashboard.user.message.created')]);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function edit(Request $request, User $user): Factory|View|Application
    {
        $context = [];
        $context['message'] = $request->get('message');
        $context['user'] = $user;

        return view('users.edit', $context);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $img = $request->file('image')->store('avatars/' . $request->user()->id, 'public');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'is_admin' => ['nullable', Rule::in(['on', 'off'])],
            'language' => ['required', Rule::in(Languages::getValues())],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $img ?? $user->image,
            'is_admin' => $request->is_admin === 'on',
            'language' => $request->language,
        ]);

        return redirect()->route('users.edit', [
            'user' => $user,
            'message' => __('dashboard.user.message.updated')
        ]);
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
