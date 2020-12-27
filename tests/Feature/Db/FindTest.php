<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class FindTest extends DbTestCase
{
    public function testFindOne(): void
    {
        $address = $this->faker->address;

        $record = $this->db->insertOne([
            'collectionName' => $this->collection,
            'document' => [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->email,
                'address' => $address,
            ],
        ]);

        $data = $this->db->findOne([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $address,
            ],
            'referencedFields' => null,
            'addReferencesFirst' => false,
            'cultureCode' => null,
            'projection' => null,
            'includeSchema' => false,
            'excludeCulture' => false,
        ]);

        $this->assertSame($record['address'], $data['address']);
    }

    public function testFindMany(): void
    {
        $items = [];

        $address = $this->faker->address;

        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'title' => $this->faker->realText(10),
                'email' => $this->faker->realText(20),
                'address' => $i >= 4 ? $address : $this->faker->realText(30),
            ];
        }

        $this->db->insertMany([
            'collectionName' => $this->collection,
            'documents' => $items,
        ]);

        $data = $this->db->findMany([
            'collectionName' => $this->collection,
            'filter' => [
                'address' => $address,
            ],
            'referencedFields' => null,
            'addReferencesFirst' => false,
            'cultureCode' => null,
            'sort' => null,
            'projection' => null,
            'pageSize' => null,
            'pageNumber' => null,
            'includeSchema' => false,
            'includeUserNames' => false,
            'includeRoleNames' => false,
            'includeCollectionNames' => false,
            'includeTermNames' => false,
            'excludeCulture' => false,
        ]);

        $this->assertCount(2, $data);
    }
}
