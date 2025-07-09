<?php

namespace PostcodeWizard;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PostcodeWizard
{
    protected Client $httpClient;
    protected string $apiKey;

    public function __construct(string $apiKey, ?string $baseUri = null)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client([
            'base_uri' => $baseUri ?? 'https://api.postcodewizard.nl/',
            'headers' => [
                'Accept' => 'application/json',
                'x-api-key' => $this->apiKey,
            ],
        ]);
    }

    public function lookup(string $postcode, string $houseNumber): array
    {
        $query = ['postcode' => $postcode, 'houseNumber' => $houseNumber];

        try {
            $response = $this->httpClient->get('lookup', [
                'query' => $query,
            ]);

            return json_decode((string)$response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? (string)$e->getResponse()->getBody() : null,
            ];
        }
    }

    public function autocomplete(string $query): array
    {
        try {
            $response = $this->httpClient->get('autocomplete', [
                'query' => ['query' => $query],
            ]);

            return json_decode((string)$response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? (string)$e->getResponse()->getBody() : null,
            ];
        }
    }
}
