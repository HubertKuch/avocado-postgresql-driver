<?php

namespace Hubert\PostgreSQLDriver\Tests\Connection;

use Avocado\DataSource\Drivers\Connection\Connection;
use Hubert\PostgreSQLDriver\Connection\PostgreSQLConnection;
use PDO;
use PHPUnit\Framework\TestCase;

class PostgreSQLConnectionTest extends TestCase {

    private function getMockedConnection(): Connection {
        $pdo = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=testdb;user=postgres;password=test;options='-c client_encoding=utf8'");

        return new PostgreSQLConnection($pdo);
    }

    public function testQueryBuilder() {
        self::assertNotNull($this->getMockedConnection()->queryBuilder());
    }

    public function testMapper() {
        self::assertNotNull($this->getMockedConnection()->mapper());
    }

    public function testPrepare() {
        self::assertNotNull($this->getMockedConnection()->prepare("SELECT * FROM cities"));
    }
}
