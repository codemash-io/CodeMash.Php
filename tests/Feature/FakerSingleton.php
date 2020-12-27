<?php

declare(strict_types=1);

namespace Tests\Feature;

use Faker\Factory;
use Faker\Generator;

final class FakerSingleton
{
    /**
     * @var null|Generator
     */
    private static $instance;

    public static function getInstance(): Generator
    {
        if (is_null(self::$instance)) {
            echo '*setup*';
            self::$instance = Factory::create();
        }

        return self::$instance;
    }
}
