<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

final class DeleteNotificationTest extends PushNotificationTestCase
{
    public function testDeleteNotification(): void
    {
        $response = $this->pushNotification->deleteNotification([
            'id' => $this->notificationId,
        ]);

        $this->assertSame(204, $response);
    }
}
