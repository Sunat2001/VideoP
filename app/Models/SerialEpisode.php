<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

/**
 * App\Models\SerialEpisode
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $season_number
 * TODO: Переделать в админке c season_number на episode_number
 * @property int $episode_number
 * @property int $serial_episode_season_id
 * @property int $serial_id
 * @property-read Serial $serial
 * @property-read SerialEpisodeSeason $season
 * @property-read SerialEpisodeVideo[] $serialEpisodeVideos
 * @method static Builder|SerialEpisode newModelQuery()
 * @method static Builder|SerialEpisode newQuery()
 * @method static Builder|SerialEpisode query()
 * @method static Builder|SerialEpisode whereDescription($value)
 * @method static Builder|SerialEpisode whereEpisodeNumber($value)
 * @method static Builder|SerialEpisode whereId($value)
 * @method static Builder|SerialEpisode whereName($value)
 * @method static Builder|SerialEpisode whereSeasonNumber($value)
 * @method static Builder|SerialEpisode whereSerialEpisodeSeasonId($value)
 * @method static Builder|SerialEpisode whereSerialId($value)
 * @mixin \Eloquent
 * @property-read int|null $serial_episode_videos_count
 */
class SerialEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'rate',
        'episode_number',
        'serial_id',
        'season_id',
    ];

    protected $casts = [
        'rate' => 'float',
        'name' => 'array',
        'description' => 'array',
    ];

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(SerialEpisodeSeason::class);
    }

    public function serialEpisodeVideos(): HasMany
    {
        return $this->hasMany(SerialEpisodeVideo::class);
    }

    public function nameByLanguage(string $language): string
    {
        return json_decode($this->getRawOriginal('name'), true)[$language] ?? '';
    }

    public function descriptionByLanguage(string $language): string
    {
        return json_decode($this->getRawOriginal('description'), true)[$language] ?? '';
    }

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true)[App::currentLocale()] ?? '',
        );
    }

    protected function description(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true)[App::currentLocale()] ?? '',
        );
    }
}
