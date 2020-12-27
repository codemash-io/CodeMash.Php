<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class CountTest extends DbTestCase
{
    protected string $address;

    public function testCount(): void
    {
        $items = [];

        $this->address = $this->faker->asciify(str_repeat('*', 30));

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $i >= 2 ? $this->address : $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $dataFiltered = $this->db->count([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $this->address,
            ],
            'limit' => $params['limit'] ?? null,
            'skip' => $params['skip'] ?? null,
        ]);

        $this->assertEquals(4, $dataFiltered);

        $dataFiltered = $this->db->count([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $this->address,
            ],
            'limit' => 3,
        ]);

        $this->assertEquals(3, $dataFiltered);

        $dataFiltered = $this->db->count([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $this->address,
            ],
            'skip' => 3,
        ]);

        $this->assertEquals(1, $dataFiltered);
    }
}
