<?php

declare(strict_types=1);

namespace Tests\Feature\PushNotificationDevice;

final class UpdateTest extends PushNotificationDeviceTestCase
{
    protected string $deviceId;

    protected function setUp(): void
    {
        parent::setUp();

        $device = $this->pushNotification->registerDevice();
        $this->deviceId = $device['id'];
    }

    public function testUpdateDeviceMeta(): void
    {
        $response = $this->pushNotification->updateDeviceMeta([
            'id' => $this->deviceId,
            'meta' => ['Brand' => 'Apple'],
        ]);

        $this->assertTrue($response);
    }

    public function testUpdateDeviceTimezone(): void
    {
        $response = $this->pushNotification->updateDeviceTimezone([
            'id' => $this->deviceId,
            'timezone' => 'Europe/Vilnius',
        ]);

        $this->assertTrue($response);
    }

    public function testUpdateDeviceUser(): void
    {
        $user = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $response = $this->pushNotification->updateDeviceUser([
            'id' => $this->deviceId,
            'userId' => $user['id'],
        ]);

        $this->assertTrue($response);
    }
}
