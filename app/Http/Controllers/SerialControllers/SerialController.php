<?php

namespace App\Http\Controllers\SerialControllers;

use App\Enum\ReviewHistoryTypes;
use App\Enum\ReviewStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialByAttributeRequest;
use App\Http\Requests\Serials\StoreReviewRequest;
use App\Http\Requests\Serials\TopSerialsRequest;
use App\Http\Resources\Serials\SeasonSerialsResource;
use App\Http\Resources\Serials\SerialResource;
use App\Http\Resources\Serials\TopSerialsResource;
use App\Models\AttributeValue;
use App\Models\Review;
use App\Models\ReviewHistory;
use App\Models\Serial;
use App\Models\SerialEpisodeSeason;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SerialController extends Controller
{
    /**
     * @param TopSerialsRequest $request
     * @return AnonymousResourceCollection
     */
    public function topSerials(TopSerialsRequest $request): AnonymousResourceCollection
    {
        return TopSerialsResource::collection(Serial::query()->withCount('serialEpisodeSeasons')
            ->orderBy($request->get('order_by'), 'desc')
            ->paginate($request->get('per_page')));
    }

    /**
     * @param Serial $serial
     * @return AnonymousResourceCollection
     */
    public function serialSeasons(Serial $serial): AnonymousResourceCollection
    {
        $serial->load('serialEpisodeSeasons.serialEpisodes');

        return SeasonSerialsResource::collection($serial->serialEpisodeSeasons->sortBy('season_number'));
    }

    /**
     * @param Serial $serial
     * @return SerialResource
     */
    public function serialById(Serial $serial): SerialResource
    {
        $relation = [
            'attributeValues.attribute',
            'reviews' => function (Builder $query) {
                $query->where('status', ReviewStatuses::APPROVED)->sortByDesc('vote');
            },
            'reviews.user',
        ];

        $serial->load($relation);

        $serial->attribute_values = $serial->attributeValues->groupBy('attribute.name');

        foreach ($serial->attribute_values as $value) {
            $value->transform(function ($item) {
                return $item->only(['id', 'name']);
            });
        }

        return new SerialResource($serial);
    }

    /**
     * Выводить все серии сезона
     *
     * @param SerialEpisodeSeason $season
     * @return SeasonSerialsResource
     */
    public function serialsBySeason(SerialEpisodeSeason $season): SeasonSerialsResource
    {
        $season->load('serialEpisodes.serialEpisodeVideos');

        return new SeasonSerialsResource($season);
    }

    /**
     * @param SerialByAttributeRequest $request
     * @param AttributeValue $attributeValue
     * @return mixed
     */
    public function serialByAttributeValue(SerialByAttributeRequest $request, AttributeValue $attributeValue): AnonymousResourceCollection
    {
        return SerialResource::collection(Serial::query()->whereHas('attributeValues', function ($query) use ($attributeValue) {
            $query->where('attribute_values.id', $attributeValue->id);
        })->paginate($request->get('per_page')));
    }

    /**
     * @param StoreReviewRequest $request
     * @return JsonResponse
     */
    public function addReview(StoreReviewRequest $request): JsonResponse
    {
        Review::query()->create([
            'serial_id' => $request->get('serial_id'),
            'user_id' => $request->user()->id,
            'text' => $request->get('text'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('frontend.serial.success_add_review'),
        ]);
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return JsonResponse
     */
    public function voteReview(Request $request, Review $review): JsonResponse
    {
        $request->validate([
            'vote' => [
                'required',
                Rule::in(['up', 'down'])
            ],
        ]);

        if ($request->user()->id === $review->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => __('frontend.serial.error_vote_for_your_review')
            ], 400);
        }

        if ($review->status !== ReviewStatuses::APPROVED) {
            return response()->json([
                'status' => 'error',
                'message' => __('frontend.serial.error_vote_for_not_approved_review')
            ], 400);
        }

        $reviewHistory = ReviewHistory::query()->where('review_id', $review->id)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($reviewHistory) {
            return response()->json([
                'status' => 'error',
                'message' => __('frontend.serial.error_already_voted_for_this_review')
            ], 400);
        }

        if ($request->get('vote') === 'up') {
            DB::beginTransaction();
            try {
                ReviewHistory::query()->create([
                    'review_id' => $review->id,
                    'user_id' => $request->user()->id,
                    'type' => ReviewHistoryTypes::POSITIVE,
                ]);
                $review->increment('vote');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => __('transaction.error_insert_data'),
//                    'error' => $e->getMessage()
                ], 500);
            }
        } else {
            DB::beginTransaction();
            try {
                ReviewHistory::query()->create([
                    'review_id' => $review->id,
                    'user_id' => $request->user()->id,
                    'type' => ReviewHistoryTypes::NEGATIVE,
                ]);
                $review->decrement('vote');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => __('transaction.error_insert_data'),
//                    'error' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __('frontend.serial.success_vote_for_review'),
        ]);
    }
}
