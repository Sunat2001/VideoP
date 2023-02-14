<?php
namespace App\Services;

use App\Models\Serial;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GenerateRecommendedSerialsService
{
    public function generate(User $user): Collection
    {
        $groupedSerials = $user->seenEpisodes()->with(['serial.attributeValues'])->get();

        $attributeValuesIds = $this->calculateMostSeenAttributeValues($groupedSerials);

        return $this->fetchSerialsByAttributeValues($attributeValuesIds);
    }

    private function fetchSerialsByAttributeValues(Collection $attributeValuesIds): Collection
    {
        $ids = $attributeValuesIds->sortDesc()->take(3)->keys()->toArray();

        return Serial::with(['attributeValues'])->whereHas('attributeValues', function (Builder $query) use ($ids) {
            $query->whereIn('id', $ids);
        })->take(5)->get();
    }

    private function calculateMostSeenAttributeValues(Collection $groupedSerials): Collection
    {
        $result = $groupedSerials->map(function ($item) {
            return $item->serial->attributeValues?->groupBy('attribute_id');
        });

        return $result->flatten()->countBy('id');
    }
}
