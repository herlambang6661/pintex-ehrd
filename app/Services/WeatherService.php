<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * Create a new class instance.
     */
    protected $weatherApiKey = 'c8727c5c4c23e56945aa7967d23f0a89';
    protected $weatherBaseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    protected $nominatimBaseUrl = 'https://nominatim.openstreetmap.org/reverse';

    public function getWeather($latitude, $longitude)
    {
        $cacheKey = "weather_{$latitude}_{$longitude}";
        $weatherData = Cache::get($cacheKey);

        if (!$weatherData) {
            $response = Http::get($this->weatherBaseUrl, [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $this->weatherApiKey,
                'units' => 'metric',
                'lang' => 'id',
            ]);

            $weatherData = $response->json();
            Cache::put($cacheKey, $weatherData, now()->addMinutes(10));
        }

        return $weatherData;
    }

    public function getLocationName($latitude, $longitude)
    {
        $url = $this->nominatimBaseUrl . "?lat={$latitude}&lon={$longitude}&format=json&addressdetails=1";

        $response = Http::withHeaders([
            'User-Agent'    => 'TFI/Produksi (Administrator)',
            'Accept'        => 'application/json',
            'Connection'    => 'keep-alive',
        ])->get($url);

        // dd($response->json());

        if (!$response->successful()) {
            return [
                // 'village' => 'Unknown',
                // 'city' => 'Unknown',
                // 'city_district' => 'Unknown',
                'display_name' => 'Unknown',
            ];
        }

        $locationData = $response->json();
        $address = $locationData['address'] ?? [];
        // dd($address);

        return [
            // 'village' => $address['village'] ?? ($address['city_block'] ?? 'Unknown'),
            'neighbourhood' => $address['neighbourhood'] ?? null,
            'city_district' => $address['city_district'] ?? null,
            // 'city' => $address['city'] ?? null,
            'suburb' => $address['suburb'] ?? null,
            'display_name' => $locationData['display_name'] ?? 'Unknown',
        ];
    }

    public function getCurrentWeatherData($latitude, $longitude)
    {
        $weatherData = $this->getWeather($latitude, $longitude);
        $locationData = $this->getLocationName($latitude, $longitude);

        if (!isset($weatherData['main']['temp'])) {
            return null;
        }

        return [
            'neighbourhood' => $locationData['neighbourhood'] ?? 'Unknown',
            'suburb' => $locationData['suburb'] ?? 'Unknown',
            'city_district' => $locationData['city_district'] ?? 'Unknown',
            'display_name' => $locationData['display_name'] ?? 'Unknown',
            'temperature' => $weatherData['main']['temp'],
            'weather' => [
                [
                    'main' => $weatherData['weather'][0]['main'] ?? 'N/A',
                    'description' => $weatherData['weather'][0]['description'] ?? 'N/A',
                    'icon' => $weatherData['weather'][0]['icon'] ?? '01d',
                ],
            ],
            'track' => $weatherData['name'] ?? '',
            'coord' => [
                'lat' => $weatherData['coord']['lat'] ?? 'N/A',
                'lon' => $weatherData['coord']['lon'] ?? 'N/A',
            ],
            'main' => [
                'temp' => $weatherData['main']['temp'] ?? 'N/A',
                'temp_max' => $weatherData['main']['temp_max'] ?? 'N/A',
                'temp_min' => $weatherData['main']['temp_min'] ?? 'N/A',
                'pressure' => $weatherData['main']['pressure'] ?? 'N/A',
                'humidity' => $weatherData['main']['humidity'] ?? 'N/A',
            ],
            'wind' => [
                'speed' => $weatherData['wind']['speed'] ?? 'N/A',
                'deg' => $weatherData['wind']['deg'] ?? 'N/A',
            ],
            'clouds' => [
                'all' => $weatherData['clouds']['all'] ?? 'N/A',
            ],
            'visibility' => $weatherData['visibility'] ?? 'N/A',
            'sys' => [
                'sunrise' => $weatherData['sys']['sunrise'] ?? 'N/A',
                'sunset' => $weatherData['sys']['sunset'] ?? 'N/A',
                'country' => $weatherData['sys']['country'] ?? 'N/A',
            ],
        ];
    }
}
