<?php


namespace App\Services;
use Illuminate\Support\Facades\Http;

class StatisticsService
{
    protected $url = 'https://devtest.ge/get-country-statistics';
    protected $countries_url = 'https://devtest.ge/countries';

    public function getHeaders(): array
    {
        return  [
            'Accept' => 'application/json, text/plain, */*',
            'Content-Type: application/json'
        ];
    }

    public function getStatisticByCountry($country)
    {
        $data = [
            'code' => $country->code,
        ];
        $response = Http::withHeaders($this->getHeaders())->post($this->url, $data);
        return $response->json();
    }

    public function getCountries()
    {
        $response = Http::withHeaders($this->getHeaders())->get($this->countries_url);
        return array_map(function ($country) {
            return ['code' => $country['code'], 'name' => json_encode($country['name'],JSON_UNESCAPED_UNICODE)];
        }, $response->json());

    }
}
