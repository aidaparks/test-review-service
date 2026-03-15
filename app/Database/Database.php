<?php

namespace App\Database;

use PDO;

class Database
{
    public static function getConnection(): PDO
    {
        return new PDO(
            'mysql:host=db-task;dbname=task;charset=utf8mb4',
            'task',
            'task',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
