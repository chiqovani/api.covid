<?php

namespace App\Http\Controllers;

use App\Models\Statistics;
use App\Http\Resources\SummaryCollection;


class SummaryController extends Controller
{
    public function getSummary(): SummaryCollection
    {
        $statistics = new Statistics();
        return new SummaryCollection($statistics->getSummary());
    }
}
