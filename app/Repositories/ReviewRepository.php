<?php

namespace App\Repositories;

use PDO;

class ReviewRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(int $clientId, int $rating, ?string $comment): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO reviews (client_id, rating, comment) VALUES (:client_id, :rating, :comment)'
        );

        $stmt->execute([
            'client_id' => $clientId,
            'rating' => $rating,
            'comment' => $comment,
        ]);
    }
}
