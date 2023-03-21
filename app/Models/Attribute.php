<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

/**
 * App\Core\Cash\Models\Attribute
 *
 * @property integer $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|AttributeValue[] $attributeValues
 * @method static Builder|Attribute newModelQuery()
 * @method static Builder|Attribute newQuery()
 * @method static Builder|Attribute query()
 * @method static Builder|Attribute whereBranchId($value)
 * @method static Builder|Attribute whereCashierId($value)
 * @method static Builder|Attribute whereCore1Id($value)
 * @method static Builder|Attribute whereCreatedAt($value)
 * @method static Builder|Attribute whereId($value)
 * @method static Builder|Attribute whereNumber($value)
 * @method static Builder|Attribute whereUpdatedAt($value)
 * @mixin Eloquent
 * @property bool $is_active
 * @method static Builder|Attribute whereActive($value)
 * @method static findOrFail(mixed $get)
 */
class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
    ];

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function nameByLanguage(string $language): string
    {
        return json_decode($this->getRawOriginal('name'), true)[$language] ?? '';
    }

    protected function name(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new \Illuminate\Database\Eloquent\Casts\Attribute(
            get: fn ($value) => json_decode($value, true)[App::currentLocale()] ?? '',
        );
    }
}
