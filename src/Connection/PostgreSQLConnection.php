<?php

namespace Hubert\PostgreSQLDriver\Connection;

use Avocado\AvocadoORM\Mappers\Mapper;
use Avocado\DataSource\Builder\Builder;
use Avocado\DataSource\Database\Statement\Statement;
use Avocado\DataSource\Drivers\Connection\Connection;
use Hubert\PostgreSQLDriver\Builder\PostreSQLBuilder;
use Hubert\PostgreSQLDriver\Mapper\PostreSQLMapper;
use Hubert\PostgreSQLDriver\Statement\PostgreSQLStatement;
use PDO;

class PostgreSQLConnection implements Connection {

    public function __construct(private ?PDO $db) {}

    public function prepare(string $sql): Statement {
        return new PostgreSQLStatement($this->db, $sql);
    }

    public function queryBuilder(): Builder {
        return new PostreSQLBuilder();
    }

    public function mapper(): Mapper {
        return new PostreSQLMapper();
    }

    public function close(): void {
        $this->db = null;
    }
}