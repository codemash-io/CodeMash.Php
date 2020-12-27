<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class UpdateTest extends DbTestCase
{
    protected string $recordToUpdateId;

    protected string $recordToUpdateEmail;

    protected function setUp(): void
    {
        parent::setUp();

        $email = $this->faker->safeEmail;

        $record = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $email,
                'address' => $this->faker->realText(30),
            ],
        ]);

        $this->recordToUpdateId = $record['_id'];
        $this->recordToUpdateEmail = $email;
    }

    public function testUpdateOne(): void
    {
        $data = $this->db->updateOne([
            'collectionName' => $this->collection,
            'id' => $this->recordToUpdateId,
            'update' => [
                '$set' => [
                    'title' => $this->faker->asciify(str_repeat('*', 10)),
                    'email' => $this->faker->asciify(str_repeat('*', 20)),
                    'address' => $this->faker->asciify(str_repeat('*', 30)),
                ],
            ],
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'isUpsert' => false,
            'ignoreTriggers' => false,
        ]);

        $this->assertSame(1, $data['modifiedCount']);
    }

    public function testUpdateOneWithFilter(): void
    {
        $data = $this->db->updateOneWithFilter([
            'collectionName' => $this->collection,
            'filter' => [
                'email' => $this->recordToUpdateEmail,
            ],
            'update' => [
                '$set' => [
                    'title' => $this->faker->asciify(str_repeat('*', 10)),
                ],
            ],
            'bypassDocumentValidation' => false,
            'waitForFileUpload' => false,
            'isUpsert' => false,
            'ignoreTriggers' => false,
        ]);

        $this->assertSame(1, $data['modifiedCount']);
    }

    public function testUpdateMany(): void
    {
        $items = [];

        $address = $this->faker->asciify(str_repeat('*', 30));

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $i >= 2 ? $address : $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $data = $this->db->updateMany([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $address,
            ],
            'update' => [
                '$set' => [
                    'title' => $this->faker->asciify(str_repeat('*', 10)),
                ],
            ],
            'bypassDocumentValidation' => false,
            'isUpsert' => false,
            'ignoreTriggers' => false,
        ]);

        $this->assertSame(4, $data['matchedCount']);
        $this->assertSame(4, $data['modifiedCount']);
    }
}
