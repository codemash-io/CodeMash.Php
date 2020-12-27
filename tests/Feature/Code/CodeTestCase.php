<?php

declare(strict_types=1);

namespace Tests\Feature\Code;

use CodeMash\Code;
use Tests\Feature\FeatureTestCase;

class CodeTestCase extends FeatureTestCase
{
    protected Code $code;

    protected string $functionId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->code = new Code($this->client);
        $this->functionId = getenv('CODEMASH_API_TEST_FUNCTION_ID');
    }
}
