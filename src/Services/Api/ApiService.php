<?php

namespace App\Services\Api;

use GuzzleHttp\Client;

class ApiService
{
    private Client $client;
    private string $token = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';
    private string $apiUrl = 'https://crm.belmar.pro/api/v1/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'token' => $this->token,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function addLead(array $data): array
    {
        $response = $this->client->post('addlead', [
            'json' => $data
        ]);
        return json_decode($response->getBody(), true);
    }

    public function getStatuses(string $dateFrom, string $dateTo): array
    {
        $response = $this->client->post('getstatuses', [
            'json' => [
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'page' => 0,
                'limit' => 100
            ]
        ]);
        return json_decode($response->getBody(), true);
    }
}
