<?php

namespace App\Http\Controllers;

use App\Enum\ReviewStatuses;
use App\Models\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $context["reviews"] = Review::query()->paginate(10);
        $context['reviewsOnModeration'] = Review::query()->where('status', ReviewStatuses::ON_MODERATION)->paginate(10);
        $context['reviewsApproved'] = Review::query()->where('status', ReviewStatuses::APPROVED)->paginate(10);
        $context['reviewsRejected'] = Review::query()->where('status', ReviewStatuses::REJECTED)->paginate(10);
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

    public function changeStatus(Request $request, Review $review): RedirectResponse
    {
        $this->validate($request, [
            'status' => ['required', Rule::in(ReviewStatuses::getModerationStatuses())]
        ]);

        $review->update([
            'status' => $request->get('status')
        ]);

        return redirect()->route('reviews.index', ['message' => $this->getReviewMessage($request->get('status'))]);
    }

    public function changeBest(Review $review)
    {
        if ($review->status !== ReviewStatuses::APPROVED) {
            return redirect()->route('reviews.index', ['message' => __('dashboard.review.message.error_review_must_be_approved')]);
        }

        $isBestExist = Review::query()
            ->where('serial_id', $review->serial_id)
            ->where('is_best', true)
            ->whereNot('id', $review->id)
            ->exists();

        if ($isBestExist) {
            return redirect()->route('reviews.index', ['message' => __('dashboard.review.message.error_best_review_already_exist')]);
        }

        $review->update([
            'is_best' => !$review->is_best
        ]);

        return redirect()->route('reviews.index', ['message' => __('dashboard.review.message.best_review_changed')]);
    }

    private function getReviewMessage(string $status): string
    {
        return match ($status) {
            ReviewStatuses::APPROVED => __('dashboard.review.message.approved'),
            ReviewStatuses::REJECTED => __('dashboard.review.message.rejected'),
            default => '',
        };
    }
}
