## PostgreSQL driver implementation for Avocado
Based on **PDO**, **PDO_PSQL** and `Avocado 8.0.0-dev`.

## Use example
```php
#[Configuration]
class DataSourceConfiguration {

    public function __construct(){}

    #[Leaf]
    public function dataSource(): DataSource {
        return (new DataSourceBuilder())
            ->server("...")
            ->databaseName("...")
            ->username("...")
            ->password("...")
            ->port("...")
            ->charset("...")
            ->driver(PostgreSQLDriver::class)
            ->build();
    }
}
```