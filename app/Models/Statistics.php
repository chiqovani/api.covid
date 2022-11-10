<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Statistics extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded;

    public function getAllCountryStatistics() {
        return self::with('country')->get();
    }

    public function getSummary() {
        return self::select(DB::raw('sum(death) as death, sum(confirmed) as confirmed, sum(recovered) as recovered'))->get();
    }

    public function country(): HasOne
    {
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }
}
