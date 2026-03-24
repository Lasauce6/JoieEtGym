<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Geocoder
{
    protected Client $client;
    protected string $baseUrl = 'https://nominatim.openstreetmap.org/search';

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => 'JoieEtGym/1.0 (joieetgym@gmail.com)',
            ],
        ]);
    }

    public function geocode(?string $address): ?array
    {
        if (empty($address)) {
            return null;
        }

        try {
            $response = $this->client->get($this->baseUrl, [
                'query' => [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (!empty($data[0])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lon' => (float) $data[0]['lon'],
                ];
            }
        } catch (GuzzleException $e) {
            logger()->error('Geocoding failed: ' . $e->getMessage());
        }

        return null;
    }
}
