<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

final class SendNotificationTest extends PushNotificationTestCase
{
    public function testSendNotification(): void
    {
        $user = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $data = $this->pushNotification->sendNotification([
            'templateId' => $this->pushNotificationTemplateId,
            'roles' => null,
            'users' => $user['id'],
            'devices' => null,
            'isNonPushable' => false,
            'tokens' => null,
            'postpone' => null,
            'respectTimeZone' => false,
        ]);

        $this->assertIsString($data);
        $this->assertNotEmpty($data);
    }
}
