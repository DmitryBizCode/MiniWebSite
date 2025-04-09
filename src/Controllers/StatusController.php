<?php

namespace App\Controllers;

use App\Services\Api\ApiService;

class StatusController
{
    public function showStatuses($dateFrom = null, $dateTo = null)
    {
        if (isset($dateFrom) && isset($dateTo) && $dateFrom > $dateTo) {
            echo "Error: 'From' date cannot be later than 'To' date.";
            return;
        }

        if (!isset($dateFrom) || !isset($dateTo)) {
            $dateFrom = $_GET['date_from'] ?? date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dateTo = $_GET['date_to'] ?? date('Y-m-d 23:59:59');
        }

        $formattedDateFrom = date('Y-m-d H:i:s', strtotime($dateFrom));
        $formattedDateTo = date('Y-m-d H:i:s', strtotime($dateTo));

        $api = new ApiService();
        $response = $api->getStatuses($formattedDateFrom, $formattedDateTo);

        if ($response['status'] === true) {
            $statuses = $response['data'] ?? [];
        } else {
            echo "Error: " . $response['error'];
            return;
        }

        require __DIR__ . '/../Views/statuses.php';
    }
}
