<?php

declare(strict_types=1);

namespace App\Services;

use App\Clients\DosableClient;
use App\DTOs\AnswerDTO;
use Illuminate\Support\Facades\Log;
use Throwable;

class DosableIntakeService
{
    public function __construct(private DosableClient $client)
    {
    }

    public function handleFormsortSubmission(array $payload): string
    {
        try {
            Log::info('Starting formsort submission.', ['payload' => $payload]);

            $sessionData = $this->client->createSession();
            Log::info('Session created.', ['session_id' => $sessionData['session_id']]);

            $data = [
                "tenant_id" => $sessionData['order']['tenant_id'],
                "email" => $payload['email'] ?? null,
                "phone" => $payload['phone'] ?? null,
                "name" => $payload['name'] ?? null,
                "first_name" => $payload['first_name'] ?? null,
                "last_name" => $payload['last_name'] ?? null,
                "role" => 0,
                "sessionId" => $sessionData['session_id'],
                "birthday" => $payload['birthday'] ?? null,
                "gender" => $payload['gender'] ?? null,
                "crosscheck" => null,
                "verification" => null,
                "id_verification_response" => null,
                "id_verification_requested" => 0,
                "id_verification_count" => 0,
                "lead_state" => $payload['lead_state'] ?? null,
                "user_id" => $sessionData['user_id'],
                "password" => null
            ];

            Log::info('Creating lead.', ['data' => $data]);

            $lead = $this->client->createLead($data, $sessionData['user_id']);

            Log::info('Lead created.', ['lead' => $lead]);

            $answers = AnswerDTO::fromFlatArray($payload);

            Log::info('Submitting answers.', ['answers' => $answers]);

            $res = $this->client->submitAnswers($sessionData['session_id'], $answers);
            $resBody = $res->getBody()->getContents();

            Log::info('Answers submitted.', ['response_body' => $resBody]);

            $completionResponse = $this->client->completeSession($sessionData['session_id']);
            Log::info('Session completed.', ['session_id' => $sessionData['session_id']]);

            $decodedData = json_decode($completionResponse, true);
            return $decodedData['checkout_url'];

        } catch (Throwable $e) {
            Log::error('Formsort submission failed.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}

