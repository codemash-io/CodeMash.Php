<?php

declare(strict_types=1);

namespace Tests\Feature\Membership;

final class RegisterTest extends MembershipTestCase
{
    public function testRegister(): void
    {
        $data = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'roles' => null,
            'autoLogin' => false,
            'meta' => null,
        ]);

        $this->assertNotEmpty($data['id']);
    }
}
