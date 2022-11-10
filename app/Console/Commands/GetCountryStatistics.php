<?php

namespace App\Console\Commands;

use App\Jobs\GetCountryStatisticsJob;
use App\Models\Countries;
use Illuminate\Console\Command;

class GetCountryStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that is getting country statistics';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countries = Countries::all();
        foreach ($countries as $country) {
            dispatch(new GetCountryStatisticsJob($country));
        }
    }
}
