<?php

namespace Hubert\PostgreSQLDriver\Builder;

use Avocado\AvocadoORM\Order;
use Avocado\DataSource\Builder\Builder;
use Avocado\DataSource\Builder\SQLBuilder;

class PostreSQLBuilder implements SQLBuilder {

    public function __construct(private string $sql = "") {}

    public static function find(string $tableName, array $criteria = [], ?array $special = []): Builder {
        return new PostreSQLBuilder("SELECT * FROM $tableName" . self::buildWhereCriteria($criteria));
    }

    public static function update(string $tableName, array $updateCriteria = [], array $findCriteria = []): Builder {
        return new PostreSQLBuilder("UPDATE $tableName" . self::buildUpdateCriteria($updateCriteria) . self::buildWhereCriteria($findCriteria));
    }

    public static function delete(string $tableName, array $criteria = []): Builder {
        return new PostreSQLBuilder("DELETE FROM $tableName" . self::buildWhereCriteria($criteria));
    }

    public static function save(string $tableName, object $object): Builder {
        $vars = get_object_vars($object);
        $asc = (array) $object;

        return new PostreSQLBuilder("INSERT INTO $tableName" . self::arrayToInsertColumns($asc) . " VALUES " . self::arrayToInsertValues($asc));
    }

    public function limit(int $limit): Builder {
        $this->sql .= " LIMIT $limit ";

        return $this;
    }

    public function offset(int $offset): Builder {
        $this->sql .= " OFFSET $offset ";

        return $this;
    }

    public function orderBy(string $field, Order $order): Builder {
        $this->sql .= " ORDER BY $field {$order->value}";

        return $this;
    }

    public function get(): string {
        return $this->sql;
    }

    private static function buildWhereCriteria(array $criteria): string {
        $sql = empty($criteria) ? "" : " WHERE ";

        foreach ($criteria as $key => $value) {
            $sql .= " $key ";

            if (is_string($value)) {
                $sql .= " LIKE '$value'";

                continue;
            }

            $sql .= " = $value AND";
        }

        return rtrim($sql, "AND");
    }

    private static function buildUpdateCriteria(array $criteria): string {
        $sql = empty($criteria) ? "": " SET ";

        foreach ($criteria as $key => $value) {
            $sql .= " $key = $value,";
        }

        return rtrim($sql, ',');
    }

    private static function arrayToInsertValues(array $array): string {
        $str = "(";

        foreach ($array as $key => $val) {
            if (is_null($val)) {
                $str .= "NULL,";
                continue;
            } else if (is_string($val)) {
                $str .= "'$val',";
                continue;
            } else {
                $str .= "$val,";
            }
        }

        return rtrim($str, ",") . ")";
    }

    private static function arrayToInsertColumns(array $array): string {
        $str = "(";

        var_dump($array);

        foreach ($array as $key => $value) {
            $str .= "$key,";
        }

        return rtrim($str, ",") . ")";
    }
}