<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * App\Core\Users\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $image
 * @property string|null $email_verified_at
 * @property bool $is_admin
 * @property string|null $remember_token
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SerialEpisode[] $seenEpisodes
 *
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'email_verified_at',
        'is_admin',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return BelongsToMany
     */
    public function seenEpisodes(): BelongsToMany
    {
        return $this->belongsToMany(SerialEpisode::class, 'user_episode_viewed', 'user_id', 'video_episode_id');
    }

    /**
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => bcrypt($value),
        );
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
