<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $user_id
 * @property int $serial_id
 *
 * @property-read User $user
 * @property-read Serial $serial
 *
 * @method static Builder|Review newModelQuery()
 * @method static Builder|Review newQuery()
 * @method static Builder|Review query()
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereSerialId($value)
 * @method static Builder|Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'serial_id',
        'user_id',
    ];

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
