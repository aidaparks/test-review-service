<?php

namespace App\Services;

use App\Interfaces\SurveyInterface;
use App\Repositories\ClientRepository;
use App\Repositories\ReviewRepository;
use App\Validation\ReviewValidator;

class ReviewService implements SurveyInterface
{
    public function __construct(
        private ClientRepository $clientRepository,
        private ReviewRepository $reviewRepository,
        private ReviewValidator $validator
    ) {
    }

    public function isClientAvailable(int $clientId): bool
    {
        return $this->clientRepository->existsById($clientId);
    }

    public function submit(array $data): array
    {
        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $clientId = (int) $data['client_id'];

        if (!$this->clientRepository->existsById($clientId)) {
            return [
                'success' => false,
                'errors' => [
                    'client_id' => 'Клиент не найден.',
                ],
            ];
        }

        $rating = (int) $data['rating'];
        $comment = trim((string) ($data['comment'] ?? ''));
        $comment = $comment !== '' ? $comment : null;

        $this->reviewRepository->create($clientId, $rating, $comment);

        return [
            'success' => true,
            'errors' => [],
        ];
    }
}
