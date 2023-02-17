<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class VerificationCode
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $otp
 * @property \DateTime $expire_at
 * @property bool $can_password_reset
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 * @property User $user
 */
class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expire_at',
        'can_password_reset',
    ];

    protected $casts = [
        'expire_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
