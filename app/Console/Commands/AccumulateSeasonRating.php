<?php

namespace App\Console\Commands;

use App\Models\SerialEpisodeSeason;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AccumulateSeasonRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'season:rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for accumulating season rating';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Accumulating season rating...');
        $seasons = SerialEpisodeSeason::all();
        $bar = $this->output->createProgressBar(count($seasons));
        foreach ($seasons as $season) {
            $season->rate = $season->serialEpisodes()->avg('rate') ?? 0;
            $season->save();
            $bar->advance();
        }
        $bar->finish();
        return CommandAlias::SUCCESS;
    }
}
