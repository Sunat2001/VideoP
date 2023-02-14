<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GenerateRecommendedSerialsService
{
    public function generate(User $user): Collection
    {
        $groupedSerials = $user->seenEpisodes()->with(['serial.attributeValues'])->get();



        return $groupedSerials;
    }
}
