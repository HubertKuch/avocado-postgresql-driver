<?php

namespace Hubert\PostgreSQLDriver\Tests\Integration;

use Hubert\PostgreSQLDriver\Tests\Integration\mocks\MockedApplication;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase {

    public static function testRun(): void {
        MockedApplication::run();
        ob_flush();
    }

}