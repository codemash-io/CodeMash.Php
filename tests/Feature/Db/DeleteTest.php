<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class DeleteTest extends DbTestCase
{
    public function testDeleteOne(): void
    {
        $record = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $this->faker->realText(30),
            ],
        ]);

        $data = $this->db->deleteOne([
            'collectionName' => $this->collection,
            'id' => $record['_id'],
        ]);

        $this->assertSame(1, $data['deletedCount']);
    }

    public function testDeleteOneWithFilter(): void
    {
        $address = $this->faker->asciify(str_repeat('*', 30));

        $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $address,
            ],
        ]);

        $data = $this->db->deleteOneWithFilter([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $address,
            ],
        ]);

        $this->assertSame(1, $data['deletedCount']);
    }

    public function testDeleteMany(): void
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

        $data = $this->db->deleteMany([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $address,
            ],
        ]);

        $this->assertSame(4, $data['deletedCount']);
    }
}
