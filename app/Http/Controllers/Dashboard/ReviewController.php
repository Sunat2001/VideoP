<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ReviewStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\IndexReviewRequest;
use App\Http\Resources\User\ReviewResource;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    protected array $relations = [
        'serial',
        'user'
    ];

    /**
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(
        private readonly ReviewRepository $reviewRepository,
    ){}

    /**
     * @param IndexReviewRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexReviewRequest $request): AnonymousResourceCollection
    {
        return ReviewResource::collection(
            $this->reviewRepository->getReviewsByStatus($request->get('status'), $this->relations)
        );
    }

    /**
     * @param Review $review
     * @return ReviewResource
     */
    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review->load($this->relations));
    }

    /**
     * @param Review $review
     * @return Response
     */
    public function destroy(Review $review): Response
    {
        $this->reviewRepository->deleteReview($review);

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return Response
     * @throws ValidationException
     */
    public function changeStatus(Request $request, Review $review): Response
    {
        $this->validate($request, [
            'status' => ['required', Rule::in(ReviewStatuses::getModerationStatuses())]
        ]);

        $review->update([
            'status' => $request->get('status')
        ]);

        return response()->noContent();
    }
}
