<?php

namespace Hubert\PostgreSQLDriver\Driver;

use Avocado\DataSource\Drivers\Connection\Connection;
use Avocado\DataSource\Drivers\Driver;
use Hubert\PostgreSQLDriver\Connection\PostgreSQLConnection;
use PDO;

class PostgreSQLDriver implements Driver {

    private Connection $connection;

    public function __construct(string $username, string $password, string $server, string $database, int|string $port = 5432, string $charset = 'utf-8') {
        $db = new PDO("pgsql:host=$server;port=$port;dbname=$database;user=$username;password=$password;options='-c client_encoding=$charset'");

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection = new PostgreSQLConnection($db);
    }

    public function connect(): Connection {
        return $this->connection;
    }
}