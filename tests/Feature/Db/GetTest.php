<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class GetTest extends DbTestCase
{
    public function testGet(): void
    {
        $record = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $this->faker->realText(30),
            ],
        ]);

        $data = $this->db->get([
            'collectionName' => $this->collection,
            'id' => $record['_id'],
            'referencedFields' => null,
            'addReferencesFirst' => false,
            'cultureCode' => null,
            'projection' => null,
            'includeSchema' => false,
            'excludeCulture' => false,
        ]);

        $this->assertSame($record['_id'], $data['_id']);
    }
}
