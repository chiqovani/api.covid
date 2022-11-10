<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Countries extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $casts = [
        'name' => 'array'
    ];

    public static function getCountryCodes(): array
    {
        return self::all()->pluck('code')->toArray();
    }
}
