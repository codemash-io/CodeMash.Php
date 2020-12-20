<?php

declare(strict_types=1);

namespace Tests;

use Codemash\CodemashClient;
use Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class CodemashClientTest extends TestCase
{
    /**
     * @param string $secretKey
     * @param string $projectId
     * @param string $method
     * @param string $uri
     * @param array $options
     * @param Response $response
     * @param array $expectedHeaders
     * @param array|int $expectedResult
     *
     * @dataProvider provideTestRequest
     */
    public function testRequest(
        string $secretKey,
        string $projectId,
        string $method,
        string $uri,
        array $options,
        Response $response,
        array $expectedHeaders,
        $expectedResult
    ) {
        $mockedHttpClient = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->disableAutoReturnValueGeneration()
            ->onlyMethods(['request'])
            ->getMock();

        $client = new CodemashClient(
            $mockedHttpClient,
            $secretKey,
            $projectId
        );

        $expectedOptions = ['headers' =>  $expectedHeaders + ($options['headers'] ?? [])];

        $mockedHttpClient
            ->expects($this->once())
            ->method('request')
            ->with($method, $uri, $expectedOptions)
            ->willReturn($response);

        $actualResult = $client->request($method, $uri, $options);

        $this->assertSame($expectedResult, $actualResult);
    }

    public static function provideTestRequest(): Generator
    {
        yield 'GET /dummy-uri-0 without extra headers, returns empty array' => [
            '$secretKey' => 'dummy-secret-key-0',
            '$projectId' => 'dummy-project-id-0',
            '$method' => 'GET',
            '$uri' => '/dummy-uri-0',
            '$options' => [],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id-0',
                'Authorization' => 'Bearer dummy-secret-key-0',
            ],
            '$expectedResult' => [],
        ];

        yield 'GET /dummy-uri-1 with extra empty headers, returns empty array' => [
            '$secretKey' => 'dummy-secret-key-1',
            '$projectId' => 'dummy-project-id-1',
            '$method' => 'GET',
            '$uri' => '/dummy-uri-1',
            '$options' => ['headers' => []],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id-1',
                'Authorization' => 'Bearer dummy-secret-key-1',
            ],
            '$expectedResult' => [],
        ];

        yield 'GET /dummy-uri-2 with extra dummy-header-2, returns empty array' => [
            '$secretKey' => 'dummy-secret-key-2',
            '$projectId' => 'dummy-project-id-2',
            '$method' => 'GET',
            '$uri' => '/dummy-uri-2',
            '$options' => ['headers' => [
                'X-Dummy-Header' => 'dummy-header-2',
            ]],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id-2',
                'Authorization' => 'Bearer dummy-secret-key-2',
                'X-Dummy-Header' => 'dummy-header-2',
            ],
            '$expectedResult' => [],
        ];

        yield 'POST /dummy-uri-3, returns dummy-value-3' => [
            '$secretKey' => 'dummy-secret-key-3',
            '$projectId' => 'dummy-project-id-3',
            '$method' => 'POST',
            '$uri' => '/dummy-uri-3',
            '$options' => [],
            '$response' => new Response(200, [], '{"dummy-key-3": "dummy-value-3"}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id-3',
                'Authorization' => 'Bearer dummy-secret-key-3',
            ],
            '$expectedResult' => [
                'dummy-key-3' => 'dummy-value-3'
            ],
        ];

        yield 'POST /dummy-uri-4, returns 204 code' => [
            '$secretKey' => 'dummy-secret-key-4',
            '$projectId' => 'dummy-project-id-4',
            '$method' => 'POST',
            '$uri' => '/dummy-uri-4',
            '$options' => [],
            '$response' => new Response(204, [], '{"dummy-key-4": "dummy-value-4"}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id-4',
                'Authorization' => 'Bearer dummy-secret-key-4',
            ],
            '$expectedResult' => 204,
        ];
    }
}
