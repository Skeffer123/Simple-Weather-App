<?php

namespace Kesit\Latihanpweb;


use GuzzleHttp\Client;

class Weather {
    private Client $client;
    public function __construct(
        private readonly string $apikey = '0fa5c7356dcb3ea7c65a7b756832bfcd',
        private readonly string $apiurl = 'http://api.openweathermap.org/data/2.5/weather'

    )
    {
        $this->client = new Client();
    }

    public function getweather(string $city): array {
        $response = $this->client ->get($this->apiurl, [
            'query' => [
                'q' => $city,
                'appid' => $this->apikey,
                'units' => 'metric',
            ]
        ]);

        $weatherdata = json_decode($response->getBody()->getContents(), true);

        return [
            'city' => $weatherdata['name'],
            'temperature' => $weatherdata['main']['temp'],
            'description' => $weatherdata['weather'][0]['description'],
            'humidity' => $weatherdata['main']['humidity']
        ];
    }
}

