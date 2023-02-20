<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\IndexReviewRequest;
use App\Http\Resources\User\ReviewResource;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewRepository $reviewRepository,
    ){}

    protected array $relations = [
        'serial',
        'user'
    ];

    public function index(IndexReviewRequest $request): AnonymousResourceCollection
    {
        return ReviewResource::collection(
            $this->reviewRepository->getReviewsByStatus($request->get('status'), $this->relations)
        );
    }

    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review->load($this->relations));
    }

    public function destroy(Review $review): void
    {
        $this->reviewRepository->deleteReview($review);
    }
}
