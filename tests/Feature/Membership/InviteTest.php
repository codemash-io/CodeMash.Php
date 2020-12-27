<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class InviteTest extends MembershipTestCase
{
    public function testInvite(): void
    {
        $data = $this->membership->invite([
            'email' => $this->faker->safeEmail,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'roles' => null,
            'meta' => null,
        ]);

        $this->assertNotEmpty($data['id']);
    }
}
