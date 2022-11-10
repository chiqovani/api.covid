<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Services\StatisticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GetCountryStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $country;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($country)
    {
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StatisticsService $statisticService)
    {
        try {
            $result = $statisticService->getStatisticByCountry($this->country);
            Statistics::updateOrCreate(
                ['country_id' => $this->country->id],
                ['confirmed' => $result['confirmed'], 'recovered' => $result['recovered'], 'death' => $result['deaths']]
            );
        } catch (\Exception  $exception) {
            Log::warning($exception);
        }
    }
}
