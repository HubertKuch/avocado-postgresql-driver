<?php

namespace Hubert\PostgreSQLDriver\Statement;

use Avocado\DataSource\Database\Statement\Statement;
use PDO;

class PostgreSQLStatement implements Statement {

    public function __construct(private PDO  $pdo, private string $sql) {}

    public function execute(): array {
        $stmt = $this->pdo->query($this->sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}