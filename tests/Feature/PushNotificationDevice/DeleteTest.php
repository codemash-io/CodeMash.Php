<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotificationDevice;

final class DeleteTest extends PushNotificationDeviceTestCase
{
    public function testDeleteDevice(): void
    {
        $device = $this->pushNotification->registerDevice();

        $response = $this->pushNotification->deleteDevice([
            'id' => $device['id'],
        ]);

        $this->assertSame(204, $response);
    }

    public function testDeleteDeviceToken(): void
    {
        $device = $this->pushNotification->registerDevice();

        $response = $this->pushNotification->deleteDeviceToken([
            'id' => $device['id'],
        ]);

        $this->assertSame(204, $response);
    }
}
