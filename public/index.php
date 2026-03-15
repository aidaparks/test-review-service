<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ReviewController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controller = new ReviewController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
    exit;
}

$controller->show();
