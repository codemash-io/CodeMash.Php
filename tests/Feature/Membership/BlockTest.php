<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class BlockTest extends MembershipTestCase
{
    public function testBlockUnblockUser(): void
    {
        $record = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ]);

        $responseStatusCode = $this->membership->blockUser([
            'id' => $record['id'],
        ]);

        $this->assertSame(204, $responseStatusCode);

        $responseStatusCode = $this->membership->unblockUser([
            'id' => $record['id'],
        ]);

        $this->assertSame(204, $responseStatusCode);
    }
}
