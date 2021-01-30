<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeMash\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CodeMashTestCase extends TestCase
{
    /** @var Client|MockObject */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['request'])
            ->getMock();
    }
}
