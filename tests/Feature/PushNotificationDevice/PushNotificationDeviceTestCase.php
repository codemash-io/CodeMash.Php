<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotificationDevice;

use CodeMash\PushNotification;
use CodeMash\Membership;
use Tests\Feature\FeatureTestCase;

class PushNotificationDeviceTestCase extends FeatureTestCase
{
    protected PushNotification $pushNotification;

    protected Membership $membership;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pushNotification = new PushNotification($this->client);
        $this->membership = new Membership($this->client);
    }
}
