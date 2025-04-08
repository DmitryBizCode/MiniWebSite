<?php

namespace app\Services\App\V1;

use GuzzleHttp\Client;

class ApiClient
{
    private $client;
    private $apiToken = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';
    private $apiUrl = 'https://crm.belmar.pro/api/v1/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $this->apiToken
            ]
        ]);
    }

    // Відправка лідов
    public function addLead(array $data)
    {
        $payload = json_encode([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'countryCode' => 'GB',
            'box_id' => 28,
            'offer_id' => 5,
            'landingUrl' => $data['landingUrl'],
            'ip' => $data['ip'],
            'password' => 'qwerty12',
            'language' => 'en'
        ]);

        $response = $this->client->post('addlead', ['body' => $payload]);

        return json_decode($response->getBody(), true);
    }

    // Отримання статусів лідов
    public function getStatuses($dateFrom, $dateTo, $page = 0, $limit = 100)
    {
        $payload = json_encode([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'page' => $page,
            'limit' => $limit
        ]);

        $response = $this->client->post('getstatuses', ['body' => $payload]);

        return json_decode($response->getBody(), true);
    }
}


