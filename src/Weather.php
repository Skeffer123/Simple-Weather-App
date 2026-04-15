<?php
namespace Kesit\Latihanpweb;

use Dotenv\Dotenv;
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

use GuzzleHttp\Client;

class Weather {
    private Client $client;
    public function __construct(
        private  string $apikey = '',
        private readonly string $apiurl = 'http://api.openweathermap.org/data/2.5/weather'

    )
    {   $this->apikey = $_ENV['WEATHER_API_KEY'] ?? getenv('WEATHER_API_KEY');
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

