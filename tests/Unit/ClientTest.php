<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeMash\Client;
use Generator;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
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
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
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
        $mockedHttpClient = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->disableOriginalConstructor()
            ->disableAutoReturnValueGeneration()
            ->onlyMethods(['request'])
            ->getMock();

        $client = new Client(
            $secretKey,
            $projectId,
            $mockedHttpClient,
        );

        $expectedOptions = ['headers' => $expectedHeaders + ($options['headers'] ?? [])];

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
        yield 'GET without extra headers, returns empty array' => [
            '$secretKey' => 'dummy-secret-key',
            '$projectId' => 'dummy-project-id',
            '$method' => 'GET',
            '$uri' => '/dummy-uri',
            '$options' => [],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id',
                'Authorization' => 'Bearer dummy-secret-key',
            ],
            '$expectedResult' => [],
        ];

        yield 'GET with extra empty headers, returns empty array' => [
            '$secretKey' => 'dummy-secret-key',
            '$projectId' => 'dummy-project-id',
            '$method' => 'GET',
            '$uri' => '/dummy-uri',
            '$options' => ['headers' => []],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id',
                'Authorization' => 'Bearer dummy-secret-key',
            ],
            '$expectedResult' => [],
        ];

        yield 'GET with extra header, returns empty array' => [
            '$secretKey' => 'dummy-secret-key',
            '$projectId' => 'dummy-project-id',
            '$method' => 'GET',
            '$uri' => '/dummy-uri',
            '$options' => ['headers' => [
                'X-Dummy-Header' => 'dummy-header',
            ]],
            '$response' => new Response(200, [], '{}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id',
                'Authorization' => 'Bearer dummy-secret-key',
                'X-Dummy-Header' => 'dummy-header',
            ],
            '$expectedResult' => [],
        ];

        yield 'POST' => [
            '$secretKey' => 'dummy-secret-key',
            '$projectId' => 'dummy-project-id',
            '$method' => 'POST',
            '$uri' => '/dummy-uri',
            '$options' => [],
            '$response' => new Response(200, [], '{"dummy-key": "dummy-value"}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id',
                'Authorization' => 'Bearer dummy-secret-key',
            ],
            '$expectedResult' => [
                'dummy-key' => 'dummy-value'
            ],
        ];

        yield 'POST, returns 204 code' => [
            '$secretKey' => 'dummy-secret-key',
            '$projectId' => 'dummy-project-id',
            '$method' => 'POST',
            '$uri' => '/dummy-uri',
            '$options' => [],
            '$response' => new Response(204, [], '{"dummy-key": "dummy-value"}'),
            '$expectedHeaders' => [
                'X-CM-ProjectId' => 'dummy-project-id',
                'Authorization' => 'Bearer dummy-secret-key',
            ],
            '$expectedResult' => 204,
        ];
    }
}
