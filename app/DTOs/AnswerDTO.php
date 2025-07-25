<?php

declare(strict_types=1);

namespace App\DTOs;

class AnswerDTO
{
    public function __construct(
        public readonly string $value,
        public readonly string $question
    ) {
    }

    public static function fromFlatArray(array $data): array
    {
        $answers = [];

        foreach ($data as $key => $value) {
            if (str_ends_with($key, '.value')) {
                $id = str_replace('.value', '', $key);
                $answers[$id]['value'] = $value;
            }

            if (str_ends_with($key, '.question')) {
                $id = str_replace('.question', '', $key);
                $answers[$id]['question'] = $value;
            }
        }

       return $answers;
    }
}

