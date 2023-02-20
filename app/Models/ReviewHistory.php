<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ReviewHistory
 *
 * @property int $id
 * @property string $type
 * @property int $review_id
 * @property int $user_id
 *
 * @property-read Review $review
 * @property-read User $user
 *
 * @method static Builder|ReviewHistory newModelQuery()
 * @method static Builder|ReviewHistory newQuery()
 * @method static Builder|ReviewHistory query()
 * @method static Builder|ReviewHistory whereId($value)
 * @method static Builder|ReviewHistory whereReviewId($value)
 * @method static Builder|ReviewHistory whereType($value)
 * @method static Builder|ReviewHistory whereUserId($value)
 * @mixin \Eloquent
 */
class ReviewHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'review_id',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
