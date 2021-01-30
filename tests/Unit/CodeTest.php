<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeMash\Code;
use CodeMash\Exceptions\RequestValidationException;
use Generator;

final class CodeTest extends CodeMashTestCase
{
    /** @var Code */
    private $code;

    protected function setUp(): void
    {
        parent::setUp();

        $this->code = new Code($this->client);
    }

    /** @dataProvider provideTestExecuteFunctionFail */
    public function testExecuteFunctionFail(
        array $params,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->code->executeFunction($params);
    }

    public static function provideTestExecuteFunctionFail(): Generator
    {
        yield 'Empty params' => [
            '$params' => [],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"id" is required!',
        ];
    }

    /**
     * @dataProvider provideTestExecuteFunction
     */
    public function testExecuteFunction(
        array $params,
        string $expectedBody,
        array $expectedResponse,
        array $expectedResult
    ): void {
        $this->client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'v2/serverless/functions/testId/execute',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $expectedBody,
                ]
            )->willReturn($expectedResponse);

        $actualResult = $this->code->executeFunction($params);

        $this->assertSame($expectedResult, $actualResult);
    }

    public static function provideTestExecuteFunction(): Generator
    {
        yield 'All parameters are set' => [
            '$params' => [
                'id' => 'testId',
                'template' => 'testTemplate',
                'qualifier' => 'testQualifier',
            ],
            '$expectedBody' => '{"id":"testId","template":"testTemplate","qualifier":"testQualifier"}',
            '$expectedResponse' => ['result' => '{"foo":"bar"}'],
            '$expectedResult' => [
                'foo' => 'bar',
            ],
        ];

        yield 'Only id is set' => [
            '$params' => [
                'id' => 'testId',
            ],
            '$expectedBody' => '{"id":"testId","template":null,"qualifier":null}',
            '$expectedResponse' => ['result' => '{"foo":"bar"}'],
            '$expectedResult' => [
                'foo' => 'bar',
            ],
        ];
    }
}
