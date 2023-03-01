<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property string $text
 * @property string $status
 * @property int $vote
 * @property bool $is_best
 * @property int $user_id
 * @property int $serial_id
 *
 * @property-read User $user
 * @property-read Serial $serial
 * @property-read ReviewHistory[] $histories
 *
 * @method static Builder|Review newModelQuery()
 * @method static Builder|Review newQuery()
 * @method static Builder|Review query()
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereText($value)
 * @method static Builder|Review whereStatus($value)
 * @method static Builder|Review wherePositive($value)
 * @method static Builder|Review whereNegative($value)
 * @method static Builder|Review whereSerialId($value)
 * @method static Builder|Review whereUserId($value)
 * @mixin Eloquent
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'status',
        'vote',
        'is_best',
        'serial_id',
        'user_id',
    ];

    protected $casts = [
        'is_best' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(ReviewHistory::class);
    }
}
