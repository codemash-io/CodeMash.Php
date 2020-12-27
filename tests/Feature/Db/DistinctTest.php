<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class DistinctTest extends DbTestCase
{
    public function testGetDistinct(): void
    {
        $items = [];

        $address = $this->faker->asciify(str_repeat('*', 30));

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $i >= 3 ? $address : $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $data = $this->db->getDistinct([
            'collectionName' => $this->collection,
            'field' => 'address',
            'filter' => null,
            'cultureCode' => null,
        ]);

        $isUnique = count($data) === count(array_flip($data));

        $this->assertTrue($isUnique);
    }
}
