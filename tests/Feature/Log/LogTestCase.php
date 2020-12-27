<?php

declare(strict_types=1);

namespace Tests\Feature\Log;

use CodeMash\Log;
use Tests\Feature\FeatureTestCase;

class LogTestCase extends FeatureTestCase
{
    protected Log $log;

    protected function setUp(): void
    {
        parent::setUp();

        $this->log = new Log($this->client);
    }
}
