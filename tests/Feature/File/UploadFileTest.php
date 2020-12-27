<?php

declare(strict_types=1);

namespace Tests\Feature\File;

final class UploadFileTest extends FileTestCase
{
    public function testUploadFile(): void
    {
        $dirToStoreIn = 'test888';
        $fileName = 'test999.txt';

        $data = $this->file->uploadFile([
            'path' => null,
            'base64' => 'MTIz',
            'fileName' => $fileName,
        ]);

        $this->assertSame($fileName, $data['originalName']);

        $tmpFilePath = tempnam('', '');
        //$tmpFileName = basename($tmpFilePath);

        file_put_contents($tmpFilePath, '123');

        $data = $this->file->uploadFile([
            'path' => $dirToStoreIn,
            'fileUri' => $tmpFilePath,
            'fileName' => $fileName,
        ]);

        $this->assertSame($fileName, $data['originalName']);
        $this->assertSame($dirToStoreIn, $data['directory']);
    }
}
