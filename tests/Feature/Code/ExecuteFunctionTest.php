<?php

declare(strict_types=1);

namespace Tests\Feature\Code;

final class ExecuteFunctionTest extends CodeTestCase
{
    public function testExecuteFunction(): void
    {
        $data = $this->code->executeFunction([
            'id' => $this->functionId,
            'template' => null,
            'qualifier' => null,
        ]);

        $this->assertIsArray($data);
    }
}
