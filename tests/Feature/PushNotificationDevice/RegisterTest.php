<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotificationDevice;

final class RegisterTest extends PushNotificationDeviceTestCase
{
    public function testRegisterDevice(): void
    {
        $data = $this->pushNotification->registerDevice([
            'userId' => null,
            'timeZone' => null,
            'meta' => null,
        ]);

        $this->assertIsString($data['id']);
        $this->assertNotEmpty($data['id']);
    }
}
