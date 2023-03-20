<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\AttributeValue
 *
 * @property int $id
 * @property string $quality
 * @property string $format
 * @property string $video_url
 * @property boolean $is_active
 * @property int $attribute_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AttributeValue newModelQuery()
 * @method static Builder|AttributeValue newQuery()
 * @method static Builder|AttributeValue query()
 * @method static Builder|AttributeValue whereAttributeId($value)
 * @method static Builder|AttributeValue whereCreatedAt($value)
 * @method static Builder|AttributeValue whereId($value)
 * @mixin \Eloquent
 * @property-read Attribute $attribute
 */

class SerialEpisodeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'quality',
        'format',
        'duration',
        'video_url',
        'serial_episode_id',
    ];

    public function serialEpisode(): BelongsTo
    {
        return $this->belongsTo(SerialEpisode::class);
    }


}
