<?php

declare(strict_types=1);

namespace Tests\Feature;

use CodeMash\Client;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class FeatureTestCase extends TestCase
{
    protected Client $client;

    protected Generator $faker;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->client = new Client(
            getenv('CODEMASH_API_SECRET_KEY'),
            getenv('CODEMASH_API_PROJECT_ID'),
            new \GuzzleHttp\Client(['base_uri' => CODEMASH_API_URL])
        );

        $this->faker = FakerSingleton::getInstance();
    }
}
