<?php

declare(strict_types=1);

namespace Tests\Feature\File;

final class UploadRecordFileTest extends FileTestCase
{
    public function testUploadRecordFile(): void
    {
        $record = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $this->faker->realText(30),
            ],
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'ignoreTriggers' => false,
        ]);

        $fileName = 'test111.txt';

        $data = $this->file->uploadRecordFile([
            'collectionName' => $this->collection,
            'recordId' => $record['_id'],
            'uniqueFieldName' => 'file',
            'base64' => 'MTIz',
            'fileName' => $fileName,
        ]);

        $this->assertSame($fileName, $data['originalName']);
    }
}
