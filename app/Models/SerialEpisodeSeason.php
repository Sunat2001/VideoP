<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SerialEpisodeSeason
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $serial_id
 * @property-read Serial $serial
 * @property-read SerialEpisode[] $serialEpisodes
 * @method static Builder|SerialEpisodeSeason newModelQuery()
 * @method static Builder|SerialEpisodeSeason newQuery()
 * @method static Builder|SerialEpisodeSeason query()
 * @method static Builder|SerialEpisodeSeason whereDescription($value)
 * @method static Builder|SerialEpisodeSeason whereId($value)
 * @method static Builder|SerialEpisodeSeason whereName($value)
 * @method static Builder|SerialEpisodeSeason whereSerialId($value)
 * @mixin \Eloquent
 * @property-read int|null $serial_episodes_count
 */
class SerialEpisodeSeason extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_number',
        'description',
        'rate',
        'is_final',
        'year',
        'serial_id',
    ];

    protected $casts = [
        'rate' => 'float',
        'is_final' => 'boolean',
        'description' => 'array',
    ];

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }

    public function serialEpisodes(): HasMany
    {
        return $this->hasMany(SerialEpisode::class, 'season_id');
    }


}
