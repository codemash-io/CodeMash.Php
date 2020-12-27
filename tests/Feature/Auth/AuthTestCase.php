<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use CodeMash\Auth;
use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class AuthTestCase extends FeatureTestCase
{
    protected Auth $auth;

    protected Membership $membership;

    protected function setUp(): void
    {
        parent::setUp();

        $this->auth = new Auth($this->client);
        $this->membership = new Membership($this->client);
    }
}
