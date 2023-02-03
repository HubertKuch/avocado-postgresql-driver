<?php

namespace Hubert\PostgreSQLDriver\Tests\Integration\mocks;

use Avocado\Application\Application;
use Avocado\AvocadoApplication\Attributes\Avocado;
use Avocado\AvocadoApplication\Attributes\Exclude;
use function PHPUnit\Framework\assertStringNotContainsString;

#[Avocado]
class MockedApplication {

    public static function run(): void {
        $_SERVER['REQUEST_METHOD'] = "GET";

        Application::run(dirname(__DIR__, 3));

        assertStringNotContainsString(ob_get_contents(), "SQLSTATE");
    }

}
