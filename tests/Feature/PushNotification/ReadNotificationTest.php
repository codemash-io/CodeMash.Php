<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

final class ReadNotificationTest extends PushNotificationTestCase
{
    public function testReadNotification(): void
    {
        $response = $this->pushNotification->readNotification([
            'id' => $this->notificationId,
        ]);

        $this->assertSame(204, $response);
    }
}
