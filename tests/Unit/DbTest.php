<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeMash\Db;
use CodeMash\Exceptions\RequestValidationException;
use Generator;

final class DbTest extends CodeMashTestCase
{
    /** @var Db */
    private $db;

    protected function setUp(): void
    {
        parent::setUp();

        $this->db = new Db($this->client);
    }

    /**
     * @dataProvider provideTestInsertOneFail
     */
    public function testInsertOneFail(
        array $params,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->db->insertOne($params);
    }

    public static function provideTestInsertOneFail(): Generator
    {
        yield 'Empty params' => [
            '$params' => [],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"collectionName" is required!',
        ];

        yield 'Missing document' => [
            '$params' => ['collectionName' => 'testCollection'],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"document" is required!',
        ];
    }

    public function testInsertOne(): void
    {
        $params = [
            'collectionName' => 'testCollection',
            'document' => 'testDocument',
        ];

        $expectedParams = [
            'collectionName' => 'testCollection',
            'document' => toJson('testDocument'),
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'ignoreTriggers' => false,
        ];

        $result = ['result' => '{}'];

        $expectedResult = [];

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'v2/db/testCollection',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => toJson($expectedParams),
                ]
            )->willReturn($result);

        $actualResult = $this->db->insertOne($params);

        $this->assertSame($expectedResult, $actualResult);
    }
}
