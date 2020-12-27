<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotification;

use CodeMash\PushNotification;
use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class PushNotificationTestCase extends FeatureTestCase
{
    protected PushNotification $pushNotification;

    protected Membership $membership;

    protected string $pushNotificationTemplateId;

    protected string $notificationId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pushNotification = new PushNotification($this->client);
        $this->membership = new Membership($this->client);
        $this->pushNotificationTemplateId = getenv('CODEMASH_API_TEST_PUSH_NOTIFICATION_TEMPLATE_ID');

        $user = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $this->pushNotification->sendNotification([
            'templateId' => $this->pushNotificationTemplateId,
            'users' => $user['id'],
            'isNonPushable' => false,
        ]);

        $notifications = $this->pushNotification->getNotifications();

        $this->notificationId = $notifications[0]['id'];
    }
}
