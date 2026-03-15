<?php

namespace App\Validation;

class ReviewValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        $clientId = $data['client_id'] ?? null;
        $rating = $data['rating'] ?? null;
        $comment = trim((string) ($data['comment'] ?? ''));

        if (empty($clientId) || filter_var($clientId, FILTER_VALIDATE_INT) === false || (int) $clientId <= 0) {
            $errors['client_id'] = 'Некорректный идентификатор клиента.';
        }

        if ($rating === null || $rating === '') {
            $errors['rating'] = 'Выберите оценку.';
        } elseif (filter_var($rating, FILTER_VALIDATE_INT) === false || (int) $rating < 1 || (int) $rating > 5) {
            $errors['rating'] = 'Оценка должна быть от 1 до 5.';
        }

        if ($comment !== '' && mb_strlen($comment) > 1000) {
            $errors['comment'] = 'Комментарий не должен превышать 1000 символов.';
        }

        return $errors;
    }
}
