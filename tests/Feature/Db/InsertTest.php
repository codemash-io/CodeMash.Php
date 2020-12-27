<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class InsertTest extends DbTestCase
{
    public function testInsertOne()
    {
        $title = $this->faker->realText(10);
        $email = $this->faker->realText(20);
        $address = $this->faker->realText(30);

        $data = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $title,
                'email' => $email,
                'address' => $address,
            ],
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'ignoreTriggers' => false,
        ]);

        $this->assertSame($title, $data['title']);
        $this->assertSame($email, $data['email']);
        $this->assertSame($address, $data['address']);
    }

    public function testInsertMany()
    {
        $items = [];

        for ($i = 1; $i <= 3; $i++) {
            $items[] = [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $this->faker->realText(30),
            ];
        }

        $data = $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'ignoreTriggers' => false,
        ]);

        $this->assertCount(3, $data);
    }
}
