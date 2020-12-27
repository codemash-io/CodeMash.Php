<?php

declare(strict_types=1);

namespace Tests\Feature\Log;

final class CreateTest extends LogTestCase
{
    public function testCreateLog(): void
    {
        $logId = $this->log->create([
            'message' => 'test log message',
            'items' => null,
            'level' => 'Warning'
        ]);

        $this->assertIsString($logId);
        $this->assertNotEmpty($logId);
    }
}
