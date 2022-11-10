<?php

namespace App\Console\Commands;

use App\Models\Countries;
use App\Services\StatisticsService;
use Illuminate\Console\Command;

class PopulateCountriesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command for populating countries table from the API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(StatisticsService $statisticService)
    {
        $countries = $statisticService->getCountries();
        Countries::truncate();
        Countries::insert($countries);
    }
}
