<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticsCollection;
use App\Models\Statistics;


class StatisticController extends Controller
{

    public function getStatistics(): StatisticsCollection
    {
        $statistics = new Statistics();
        return new StatisticsCollection($statistics->getAllCountryStatistics());
    }

}
