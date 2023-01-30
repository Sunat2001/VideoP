<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Core\Cash\Models\AttributeValue
 *
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property int $attribute_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Attribute $attribute
 * @method static Builder|AttributeValue newModelQuery()
 * @method static Builder|AttributeValue newQuery()
 * @method static Builder|AttributeValue query()
 * @method static Builder|AttributeValue whereAttributeId($value)
 * @method static Builder|AttributeValue whereCreatedAt($value)
 * @method static Builder|AttributeValue whereId($value)
 * @method static Builder|AttributeValue whereIsActive($value)
 * @method static Builder|AttributeValue whereName($value)
 * @method static Builder|AttributeValue whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static findOrFail(mixed $get)
 */
class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'attribute_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function serials(): BelongsToMany
    {
        return $this->belongsToMany(Serial::class, 'serial_attribute_value');
    }
}
