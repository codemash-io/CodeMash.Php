<?php

declare(strict_types=1);

namespace Tests\Feature\Email;

use CodeMash\Email;
use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class EmailTestCase extends FeatureTestCase
{
    protected Email $email;

    protected Membership $membership;

    protected string $emailTemplateId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->email = new Email($this->client);
        $this->membership = new Membership($this->client);
        $this->emailTemplateId = getenv('CODEMASH_API_TEST_EMAIL_TEMPLATE_ID');
    }
}
