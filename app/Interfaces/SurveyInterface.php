<?php

namespace App\Interfaces;

interface SurveyInterface
{
    public function isClientAvailable(int $clientId): bool;

    public function submit(array $data): array;
}
