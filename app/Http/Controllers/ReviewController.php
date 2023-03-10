<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $context["reviews"] = Review::query()->paginate(10);
        $context["message"] = $request->get('message');

        return view('reviews.index', $context);
    }

    /**
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('reviews.index', ['message' => __('dashboard.review.message.deleted')]);
    }
}
