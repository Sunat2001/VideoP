<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\IndexReviewRequest;
use App\Http\Resources\User\ReviewResource;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * @return void
     */
    public function destroy(Review $review): void
    {
        $this->reviewRepository->deleteReview($review);
    }

    public function changeStatus(Request $request, Review $review): void
    {
        $review->update([
            'status' => $request->get('status')
        ]);
    }
}
