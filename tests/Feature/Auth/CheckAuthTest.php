<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

final class CheckAuthTest extends AuthTestCase
{
    public function testCheckAuth(): void
    {
        $data = $this->auth->checkAuth();

        $this->assertNotEmpty($data['userId']);
    }
}
