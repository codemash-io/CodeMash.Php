<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

final class GetTemplateTest extends PushNotificationTestCase
{
    public function testGetPushNotificationTemplate(): void
    {
        $data = $this->pushNotification->getTemplate([
            'id' => $this->pushNotificationTemplateId,
        ]);

        $this->assertSame($this->pushNotificationTemplateId, $data['id']);
    }

    public function testGetPushNotificationTemplates(): void
    {
        $data = $this->pushNotification->getTemplates();

        $this->assertNotEmpty($data[0]['id']);
    }
}
