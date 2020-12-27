<?php

declare(strict_types=1);

namespace Tests\Feature\Email;

final class SendTest extends EmailTestCase
{
    public function testSendEmail(): void
    {
        $user = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $campaignId = $this->email->send([
            'templateId' => $this->emailTemplateId,
            'emails' => [$user['email']],
            'cultureCode' => null,
            'forceRequestLanguage' => null,
            'roles' => null,
            'users' => null,
            'ccEmails' => null,
            'ccUsers' => null,
            'bccEmails' => null,
            'bccUsers' => null,
            'tokens' => null,
            'postpone' => null,
            'respectTimeZone' => false,
        ]);

        $this->assertIsString($campaignId);
        $this->assertNotEmpty($campaignId);
    }
}
