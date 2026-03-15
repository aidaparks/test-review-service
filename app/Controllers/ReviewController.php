<?php

namespace App\Controllers;

use App\Database\Database;
use App\Repositories\ClientRepository;
use App\Repositories\ReviewRepository;
use App\Services\ReviewService;
use App\Validation\ReviewValidator;

class ReviewController
{
    private ReviewService $service;

    public function __construct()
    {
        $pdo = Database::getConnection();

        $clientRepository = new ClientRepository($pdo);
        $reviewRepository = new ReviewRepository($pdo);
        $validator = new ReviewValidator();

        $this->service = new ReviewService(
            $clientRepository,
            $reviewRepository,
            $validator
        );
    }

    public function show(): void
    {
        $clientId = isset($_GET['client_id']) ? (int) $_GET['client_id'] : 0;

        if ($clientId <= 0 || !$this->service->isClientAvailable($clientId)) {
            require __DIR__ . '/../Views/unavailable.php';
            return;
        }

        $errors = [];
        $old = [];

        require __DIR__ . '/../Views/form.php';
    }

    public function store(): void
    {
        $data = [
            'client_id' => $_POST['client_id'] ?? null,
            'rating' => $_POST['rating'] ?? null,
            'comment' => $_POST['comment'] ?? '',
        ];

        $result = $this->service->submit($data);

        $clientId = (int) ($data['client_id'] ?? 0);
        $old = $data;
        $errors = $result['errors'];

        if (!$result['success']) {
            if ($clientId <= 0 || isset($errors['client_id'])) {
                require __DIR__ . '/../Views/unavailable.php';
                return;
            }

            require __DIR__ . '/../Views/form.php';
            return;
        }

        require __DIR__ . '/../Views/success.php';
    }
}
