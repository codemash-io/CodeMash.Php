<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

use CodeMash\Db;
use Tests\Feature\FeatureTestCase;

class DbTestCase extends FeatureTestCase
{
    protected Db $db;

    protected string $collection;

    protected string $taxonomy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->db = new Db($this->client);
        $this->collection = getenv('CODEMASH_API_TEST_COLLECTION_TITLE');
        $this->taxonomy = getenv('CODEMASH_API_TEST_TAXONOMY_TITLE');
    }
}
