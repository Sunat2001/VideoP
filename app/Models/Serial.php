<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

/**
 * App\Core\Cash\Models\Serial
 *
 * @property int $id
 * @property string $name
 * @property string $image_cover
 * @property float $rate
 * @property string $status
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static findOrFail(mixed $get)
 * @method static Builder|Serial newModelQuery()
 * @method static Builder|Serial newQuery()
 * @method static Builder|Serial query()
 * @method static Builder|Serial whereCreatedAt($value)
 * @method static Builder|Serial whereDescription($value)
 * @method static Builder|Serial whereId($value)
 * @method static Builder|Serial whereImageCover($value)
 * @method static Builder|Serial whereName($value)
 * @method static Builder|Serial whereRate($value)
 * @method static Builder|Serial whereUpdatedAt($value)
 * @method static Builder|Serial whereStatus($value)
 * @mixin \Eloquent
 * @property-read Collection|SerialEpisode[] $serialEpisodes
 * @property-read Collection|SerialEpisodeSeason[] $serialEpisodeSeasons
 * @property-read Collection|SerialEpisodeVideo[] $serialEpisodeVideos
 * @property-read Collection|AttributeValue[] $attributeValues
 * @property-read int|null $serial_episode_seasons_count
 * @property-read int|null $serial_episode_videos_count
 * @property-read int|null $attribute_values_count
 * @property-read int|null $serial_episodes_count
 * @property-read Collection|Review[] $reviews
 * @property-read int|null $reviews_count
 */
class Serial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_cover',
        'rate',
    ];

    protected $casts = [
        'rate' => 'float',
        'name' => 'array',
        'description' => 'array',
    ];

    public function serialEpisodes(): HasMany
    {
        return $this->hasMany(SerialEpisode::class);
    }

    public function serialEpisodeSeasons(): HasMany
    {
        return $this->hasMany(SerialEpisodeSeason::class);
    }

    public function serialEpisodeVideos(): HasMany
    {
        return $this->hasMany(SerialEpisodeVideo::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'serial_attribute_value');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true)[App::currentLocale()],
        );
    }

    protected function description(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true)[App::currentLocale()],
        );
    }
}
