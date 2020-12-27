<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotificationDevice;

final class GetTest extends PushNotificationDeviceTestCase
{
    public function testGetDevice(): void
    {
        $device = $this->pushNotification->registerDevice();

        $data = $this->pushNotification->getDevice([
            'id' => $device['id'],
        ]);

        $this->assertSame($device['id'], $data['id']);
    }

    public function testGetDevices(): void
    {
        $this->pushNotification->registerDevice();

        $data = $this->pushNotification->getDevices();

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }
}
