<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Statistics;
use App\Models\Countries;
use Illuminate\Support\Facades\Http;
uses(RefreshDatabase::class);


test('test get countries command', function () {
    $country = json_encode([
        "code" =>"AF",
        "name" => [
            "en" => "Afghanistan",
            "ka" => "ავღანეთი"
        ]
    ]);
    Http::fake([
        'https://devtest.ge/countries' => Http::response([json_decode($country)], 200, ['Headers']),
    ]);


    $this->artisan('populate:countries');
    $countries = Countries::all()->toArray();
    expect($countries)->toHaveCount(1);
    expect($countries[0]['code'])->toEqual('AF');
});

test('test get country statistics command', function () {

    Countries::factory()->count(1)->create();
    Http::fake([
        'https://devtest.ge/get-country-statistics' => Http::response([
            "code" =>"AF",
            "confirmed" => 642,
            "recovered"=> 3887,
            "deaths"=> 2422,
        ], 200, ['Headers']),
    ]);

    Http::post('https://devtest.ge/get-country-statistics', ["code" => "AF"]);

    $this->artisan('statistics:get');
    $countries = Statistics::all()->toArray();
    expect($countries)->toHaveCount(1);
    expect($countries[0]['recovered'])->toEqual(3887);
    expect($countries[0]['death'])->toEqual(2422);
    expect($countries[0]['confirmed'])->toEqual(642);
});
