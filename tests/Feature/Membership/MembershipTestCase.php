<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class MembershipTestCase extends FeatureTestCase
{
    protected Membership $membership;

    protected function setUp(): void
    {
        parent::setUp();

        $this->membership = new Membership($this->client);
    }
}
