<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

final class GetNotificationTest extends PushNotificationTestCase
{
    public function testGetNotification(): void
    {
        $data = $this->pushNotification->getNotification([
            'id' => $this->notificationId,
        ]);

        $this->assertSame($this->notificationId, $data['id']);
    }

    public function testGetNotifications(): void
    {
        $data = $this->pushNotification->getNotifications([
            'userId' => null,
            'deviceId' => null,
        ]);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    public function testGetNotificationCount(): void
    {
        $data = $this->pushNotification->getNotificationCount([
            'userId' => null,
            'deviceId' => null,
        ]);

        $this->assertArrayHasKey('totalCount', $data);
    }
}
