<?php

namespace Hubert\PostgreSQLDriver\Tests\Driver;

use Avocado\DataSource\Drivers\Connection\Connection;
use Hubert\PostgreSQLDriver\Connection\PostgreSQLConnection;
use Hubert\PostgreSQLDriver\Driver\PostgreSQLDriver;
use PDO;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class PostgreSQLDriverTest extends TestCase {

    private function getConnection(): Connection {
        $pdo = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=testdb;user=postgres;password=test;options='-c client_encoding=utf8'");

        return new PostgreSQLConnection($pdo);
    }

    public function testConnect() {
        self::assertNotNull($this->getConnection());
    }

    public function test__construct() {
        ob_flush();
        assertNotNull(new PostgreSQLDriver("postgres", "test", "127.0.0.1", "testdb", 5432, 'utf8'));
    }
}
