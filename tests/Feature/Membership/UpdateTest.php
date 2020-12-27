<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class UpdateTest extends MembershipTestCase
{
    public function testUpdateProfile():void
    {
        $responseStatusCode = $this->membership->updateProfile([
            'unsubscribedNewsTags' => null,
            'subscribeToNews' => false,
            'timeZone' => null,
            'language' => null,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'meta' => null,
        ]);

        $this->assertSame(204, $responseStatusCode);
    }

    public function testUpdateUser(): void
    {
        $record = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $responseStatusCode = $this->membership->updateUser([
            'id' => $record['id'],
            'unsubscribedNewsTags' => null,
            'subscribeToNews' => false,
            'timeZone' => null,
            'language' => null,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'meta' => null,
        ]);

        $this->assertSame(204, $responseStatusCode);
    }
}
