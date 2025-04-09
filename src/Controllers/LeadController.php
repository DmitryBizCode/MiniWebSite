<?php

namespace App\Controllers;

use App\Services\Api\ApiService;
use Exception;

class LeadController
{
    public function showForm()
    {
        require __DIR__ . '/../Views/form.php';
    }
    private function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
    public function submit()
    {
        try {
            $ip = $this->getRealIpAddr();
            $landingUrl = $_SERVER['HTTP_HOST'];

            $data = [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'countryCode' => 'GB',
                'box_id' => 28,
                'offer_id' => 5,
                'landingUrl' => $landingUrl,
                'ip' => $ip,
                'password' => 'qwerty12',
                'language' => 'en'
            ];

            $api = new ApiService();
            $response = $api->addLead($data);

            header('Content-Type: application/json');

            if ($response['status'] === true) {
                echo json_encode([
                    'status' => true,
                    'id' => $response['id'],
                    'email' => $response['email']
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'error' => $response['error']
                ]);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }


}
