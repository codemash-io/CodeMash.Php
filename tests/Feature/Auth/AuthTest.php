<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

final class AuthTest extends AuthTestCase
{
    public function testAuthenticate(): void
    {
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;

        $user = $this->membership->register([
            'email' => $email,
            'password' => $password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'roles' => null,
            'autoLogin' => false,
            'meta' => null,
        ]);

        $userId = $user['id'];

        $dataAuth = $this->auth->authenticate([
            'password' => $password,
            'userName' => $email,
        ]);

        $bearerToken = $dataAuth['bearerToken'];

        $this->assertNotEmpty($bearerToken);
        $this->assertSame($userId, $dataAuth['userId']);

        $dataLogout = $this->auth->logout([
            'bearerToken' => $bearerToken,
        ]);

        $this->assertArrayHasKey('responseStatus', $dataLogout);
    }
}
