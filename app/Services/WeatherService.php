<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    private Client $client;

    public function __construct(
        private readonly string $apiKey,
        private readonly string $baseUrl = 'https://api.openweathermap.org/data/2.5/weather'

    ) {
        $this->client = new Client();
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get($this->baseUrl, [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]
        ]);
        $weatherData = json_decode($response->getBody()->getContents(), true);

        return [
            'city' => $weatherData['name'],
            'temperature' => $weatherData['main']['temp'],
            'description' => $weatherData['weather'][0]['description'],
            'humidity' => $weatherData['main']['humidity'],
            'message' => "Found the following data :",
        ];
    }
}
