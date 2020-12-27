<?php

declare(strict_types=1);

namespace Tests\Feature\File;

final class UploadUserFileTest extends FileTestCase
{
    public function testUploadUserFile(): void
    {
        $user = $this->membership->register([
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'displayName' => $this->faker->userName,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'roles' => null,
            'autoLogin' => false,
            'meta' => null,
        ]);

        $fileName = 'test333.txt';

        $data = $this->file->uploadUserFile([
            'userId' => $user['id'],
            'metaFieldName' => 'user_file',
            'base64' => 'MTIz',
            'fileName' => $fileName,
        ]);

        $this->assertSame($fileName, $data['originalName']);
    }
}
