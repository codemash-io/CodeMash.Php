<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class ReplaceTest extends DbTestCase
{
    public function testReplaceOne(): void
    {
        $title = $this->faker->asciify(str_repeat('*', 10));
        $email = $this->faker->safeEmail;
        $address = $this->faker->address;

        $items = [];

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $i >= 3 ? $title : $this->faker->realText(10),
                'email' => $i >= 3 ? $email : $this->faker->realText(20),
                'address' => $i >= 3 ? $address : $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $data = $this->db->replaceOne([
            'collectionName' => $this->collection,
            'filter' => [
                'title' => $title,
                'email' => $email,
                'address' => $address,
            ],
            'document' => [
                'title' => $this->faker->asciify(str_repeat('*', 10)),
                'email' => $this->faker->asciify(str_repeat('*', 20)),
                'address' => $this->faker->asciify(str_repeat('*', 30)),
            ],
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'isUpsert' => false,
        ]);

        $this->assertSame(1, $data['modifiedCount']);
    }
}
