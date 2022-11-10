<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $model = User::class;

    public function run()
    {
        User::factory()->count(1)->create();
    }

}
