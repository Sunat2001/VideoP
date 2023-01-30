<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\AttributeValue
 *
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property int $attribute_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 */

class SerialEpisodeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'quality',
        'format',
        'video_url',
        'serial_episode_id',
    ];

    public function serialEpisode(): BelongsTo
    {
        return $this->belongsTo(SerialEpisode::class);
    }


}
