<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $model = Countries::class;

    public function run()
    {
        Countries::factory()->count(1)->create();
    }
}
