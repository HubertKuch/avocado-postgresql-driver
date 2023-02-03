<?php

namespace Hubert\PostgreSQLDriver\Tests\Statement;

use Avocado\DataSource\Drivers\Connection\Connection;
use Avocado\ORM\AvocadoModel;
use Hubert\PostgreSQLDriver\Connection\PostgreSQLConnection;
use Hubert\PostgreSQLDriver\Statement\PostgreSQLStatement;
use Hubert\PostgreSQLDriver\Tests\mocks\MockedCityEntity;
use PDO;
use PHPUnit\Framework\TestCase;

class PostgreSQLStatementTest extends TestCase {

    private function getConnection(): Connection {
        $pdo = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=testdb;user=postgres;password=test;options='-c client_encoding=utf8'");

        return new PostgreSQLConnection($pdo);
    }

    public function testExecute() {
        $connection = $this->getConnection();
        $result = $connection->prepare($connection->queryBuilder()::find("cities", ["name" => "Boston"])->get())->execute();
        $result = array_map(fn($res) => $connection->mapper()->entityToObject(new AvocadoModel(MockedCityEntity::class), $res), $result);

        self::assertTrue($result[0] instanceof MockedCityEntity);
    }
}
