<?php

declare(strict_types=1);

namespace Codemash;

use Psr\Http\Client\ClientInterface;

class CodemashClient
{
    private ClientInterface $httpClient;

    private array $headers;

    public function __construct(ClientInterface $httpClient, string $secretKey, string $projectId)
    {
        $this->httpClient = $httpClient;
        $this->headers = [
            'X-CM-ProjectId' => $projectId,
            'Authorization' => sprintf('Bearer %s', $secretKey),
        ];
    }

    /**
     * @return array|int
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $options['headers'] = $this->headers + ($options['headers'] ?? []);

        $response = $this->httpClient->request($method, $uri, $options);

        return $response->getStatusCode() === 204
            ? $response->getStatusCode()
            : jsonToArray((string) $response->getBody());
    }
}
