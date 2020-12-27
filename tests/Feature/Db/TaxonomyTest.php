<?php

declare(strict_types=1);

namespace Tests\Feature\Db;

final class TaxonomyTest extends DbTestCase
{
    public function testGetTaxonomyTerms(): void
    {
        $data = $this->db->getTaxonomyTerms([
            'taxonomyName' => $this->taxonomy,
            'filter' => [
                'name' => [
                    '$gt' => ''
                ],
            ],
        ]);

        $this->assertNotEmpty($data[0]['id']);
        $this->assertIsString($data[0]['id']);
    }
}
