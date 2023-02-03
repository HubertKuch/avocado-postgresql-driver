<?php

namespace Hubert\PostgreSQLDriver\Tests\Integration\mocks;

use Avocado\AvocadoApplication\Attributes\Configuration;
use Avocado\AvocadoApplication\Attributes\Leaf;
use Avocado\DataSource\DataSource;
use Avocado\DataSource\DataSourceBuilder;
use Avocado\DataSource\Exceptions\CannotBuildDataSourceException;
use Hubert\PostgreSQLDriver\Driver\PostgreSQLDriver;

#[Configuration]
class MockedPsqlDataSource {

    public function __construct(){}

    /**
     * @throws CannotBuildDataSourceException
     */
    #[Leaf]
    public function dataSource(): DataSource {
        return (new DataSourceBuilder())
            ->server("127.0.0.1")
            ->databaseName("testdb")
            ->username("postgres")
            ->password("test")
            ->port("5432")
            ->charset("utf8")
            ->driver(PostgreSQLDriver::class)
            ->build();
    }

}