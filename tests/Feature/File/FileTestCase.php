<?php

declare(strict_types=1);

namespace Tests\Feature\File;

use CodeMash\Db;
use CodeMash\File;
use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class FileTestCase extends FeatureTestCase
{
    protected File $file;

    protected Db $db;

    protected Membership $membership;

    protected string $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->file = new File($this->client);
        $this->db = new Db($this->client);
        $this->membership = new Membership($this->client);
        $this->collection = getenv('CODEMASH_API_TEST_COLLECTION_TITLE');
    }
}
