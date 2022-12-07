<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class CarModel extends Model
{
    use HasFactory;
    protected $table = 'cars';

    public static function getAllCars() {
        return self::with('owner')->get();
    }

    public function owner(): HasOne
    {
        return $this->hasOne(OwnerModel::class, 'id', 'owner_id');
    }
}
