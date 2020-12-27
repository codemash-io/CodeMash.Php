<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class GetTest extends MembershipTestCase
{
    public function testGetUsers(): void
    {
        $data = $this->membership->getUsers([
            'includePermissions' => false,
            'includeDevices' => false,
            'includeMeta' => false,
        ]);

        $this->assertNotEmpty($data['totalCount']);
        $this->assertNotEmpty($data['result']);
    }

    public function testGetUser(): void
    {
        $email = $this->faker->safeEmail;

        $record = $this->membership->register([
            'email' => $email,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $data = $this->membership->getUser([
            'id' => $record['id'],
        ]);

        $this->assertSame($record['id'], $data['id']);
        $this->assertSame($email, $data['email']);
    }

    public function testGetUserByEmail(): void
    {
        $email = $this->faker->safeEmail;

        $record = $this->membership->register([
            'email' => $email,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $data = $this->membership->getUserByEmail([
            'email' => $email,
            'IncludeUnreadNotifications' => false,
            'includePermissions' => false,
            'includeDevices' => false,
            'includeMeta' => false,
        ]);

        $this->assertSame($record['id'], $data['id']);
    }
}
