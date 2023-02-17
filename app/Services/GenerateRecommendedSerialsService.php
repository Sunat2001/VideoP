<?php
namespace App\Services;

use App\Models\Serial;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GenerateRecommendedSerialsService
{
    public function generate(User $user, int $per_page): LengthAwarePaginator
    {
        $groupedSerials = $user->seenEpisodes()->with(['serial.attributeValues'])->get();

        $attributeValuesIds = $this->calculateMostSeenAttributeValues($groupedSerials);

        return $this->fetchSerialsByAttributeValues($attributeValuesIds, $per_page);
    }

    private function fetchSerialsByAttributeValues(Collection $attributeValuesIds, int $per_page): LengthAwarePaginator
    {
        $ids = $attributeValuesIds->sortDesc()->take(3)->keys()->toArray();

        return Serial::query()->whereRelation('attributeValues', function (Builder $query) use ($ids) {
            $query->whereIn('attribute_value_id', $ids);
        })->paginate($per_page);
    }

    private function calculateMostSeenAttributeValues(Collection $groupedSerials): Collection
    {
        $result = $groupedSerials->map(function ($item) {
            return $item->serial->attributeValues?->groupBy('attribute_id');
        });

        return $result->flatten()->countBy('id');
    }
}
