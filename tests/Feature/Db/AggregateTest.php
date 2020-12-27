<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class AggregateTest extends DbTestCase
{
    public function testGetAggregate(): void
    {
        $items = [];

        $title = $this->faker->asciify(str_repeat('*', 10));

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $i >= 3 ? $title : $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $data = $this->db->getAggregate([
            'collectionName' => $this->collection,
            'id' => null,
            'pipeline' => [
                '$match' => [
                    'title' => [
                        '$eq' => $title,
                    ],
                ],
            ],
            'tokens' => null,
        ]);

        $this->assertCount(3, $data);
    }
}
