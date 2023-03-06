<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewRepository
{
    /**
     * @param string|null $status
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function getReviewsByStatus(?string $status, array $relations): LengthAwarePaginator
    {
        return Review::query()
            ->with($relations)
            ->when($status, fn ($query) => $query->where('status', $status))
            ->paginate(15);
    }

    /**
     * @param Review $review
     * @return void
     */
    public function deleteReview(Review $review): void
    {
        $review->delete();
    }

}
