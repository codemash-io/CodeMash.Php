<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$projectId = '';
$secretKey = '';

$httpOptions = ['base_uri' => CODEMASH_API_URL];

$httpClient = new \GuzzleHttp\Client($httpOptions);

$cmClient = new \Codemash\Client($secretKey, $projectId, $httpClient);

$cmUser = new \Codemash\User($cmClient);

print_r($cmUser->getUsers());
