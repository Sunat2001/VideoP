<?php

namespace App\Console\Commands;

use App\Services\FetchTMDBPopularSerialsService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GetSerialsFromTMDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmdb:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get serials from TMDB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /** @var FetchTMDBPopularSerialsService $service */
        $service = app(FetchTMDBPopularSerialsService::class);

        $service->perform();

        $this->info('Serials from TMDB was successfully fetched');

        return CommandAlias::SUCCESS;
    }
}
