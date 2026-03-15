<?php

namespace App\Repositories;

use PDO;

class ClientRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function existsById(int $id): bool
    {
        $stmt = $this->pdo->prepare('SELECT 1 FROM clients WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);

        return (bool) $stmt->fetchColumn();
    }
}
