<?php

declare(strict_types=1);

namespace App\Clients;

use GuzzleHttp\Client;

class DosableClient
{
    private string $baseUrl;
    private string $token;
    private Client $httpClient;

    public function __construct()
    {
        $this->baseUrl = config('services.dosable.base_url');
        $this->token = config('services.dosable.token');
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-API-Key' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function createSession(): array
    {
        $response = $this->httpClient->post('/sessions/');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createLead(array $lead, int $userId): array
    {
        $response = $this->httpClient->post('/leads/', [
            'json' => $lead
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function submitAnswers(string $sessionId, array $answers)
    {
        return $this->httpClient->put("/sessions/{$sessionId}", [
            'json' => $answers,
        ]);
    }

    public function completeSession(string $sessionId): string
    {
        $response = $this->httpClient->post("/sessions/{$sessionId}/complete");
        return $response->getBody()->getContents();
    }
}

