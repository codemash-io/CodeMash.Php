<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeMash\Auth;
use CodeMash\Exceptions\RequestValidationException;
use Generator;

final class AuthTest extends CodeMashTestCase
{
    /** @var Auth */
    private $auth;

    protected function setUp(): void
    {
        parent::setUp();

        $this->auth = new Auth($this->client);
    }

    /**
     * @dataProvider provideTestAuthenticateFail
     */
    public function testAuthenticateFail(
        array $params,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->auth->authenticate($params);
    }

    public static function provideTestAuthenticateFail(): Generator
    {
        yield 'Empty params' => [
            '$params' => [],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"password" is required!',
        ];

        yield 'Missing userName' => [
            '$params' => ['password' => 'fooBar'],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"userName" is required!',
        ];
    }

    public function testAuthenticate(): void
    {
        $params = [
            'password' => 'testPassword',
            'userName' => 'testUserName',
        ];

        $expectedResult = ['foo' => 'bar'];

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'v2/auth/credentials',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => '{"password":"testPassword","userName":"testUserName"}',
                ]
            )->willReturn(['result' => $expectedResult]);

        $actualResult = $this->auth->authenticate($params);

        $this->assertSame($expectedResult, $actualResult);
    }

    public function testCheckAuth(): void
    {
        $expectedResult = ['foo' => 'bar'];

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'v2/auth/',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]
            )->willReturn(['result' => $expectedResult]);

        $actualResult = $this->auth->checkAuth();

        $this->assertSame($expectedResult, $actualResult);
    }

    /**
     * @dataProvider provideTestLogoutFail
     */
    public function testLogoutFail(
        array $params,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->auth->logout($params);
    }

    public static function provideTestLogoutFail(): Generator
    {
        yield 'Empty params' => [
            '$params' => [],
            '$expectedException' => RequestValidationException::class,
            '$expectedExceptionMessage' => '"bearerToken" is required!',
        ];
    }

    public function testLogout(): void
    {
        $params = [
            'bearerToken' => 'testBearerToken',
        ];

        $expectedResult = [
            'result' => [
                'foo' => 'bar'
            ],
        ];

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'auth/logout',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer testBearerToken',
                    ],
                ]
            )->willReturn($expectedResult);

        $actualResult = $this->auth->logout($params);

        $this->assertSame($expectedResult, $actualResult);
    }
}
