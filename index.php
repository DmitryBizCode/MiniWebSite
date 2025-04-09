<?php
require 'vendor/autoload.php';

use App\Controllers\LeadController;
use App\Controllers\StatusController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        (new LeadController())->showForm();
        break;
    case '/submit':
        (new LeadController())->submit();
        break;
    case '/statuses':
        (new StatusController())->showStatuses();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
}
