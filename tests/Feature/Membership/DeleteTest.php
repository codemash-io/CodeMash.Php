<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class DeleteTest extends MembershipTestCase
{
    public function testDeleteUser(): void
    {
        $record = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $responseStatusCode = $this->membership->deleteUser([
            'id' => $record['id'],
        ]);

        $this->assertSame(204, $responseStatusCode);
    }
}
