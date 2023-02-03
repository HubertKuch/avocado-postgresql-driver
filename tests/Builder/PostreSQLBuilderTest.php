<?php

namespace Hubert\PostgreSQLDriver\Tests\Builder;

use Avocado\AvocadoORM\Order;
use Hubert\PostgreSQLDriver\Builder\PostreSQLBuilder;
use PHPUnit\Framework\TestCase;
use stdClass;

class PostreSQLBuilderTest extends TestCase {

    public function testDelete() {
        $sql = PostreSQLBuilder::delete("cities")->get();

        self::assertStringContainsString("DELETE FROM cities", $sql);
    }

    public function testDeleteWithWhereClosure() {
        $sql = PostreSQLBuilder::delete("users", ["name" => "John Doe"])->get();

        self::assertStringContainsString("DELETE FROM users WHERE  name  LIKE 'John Doe'", $sql);
    }

    public function testLimit() {
        $sql = PostreSQLBuilder::delete("users", ["name" => "John Doe"])->limit(1)->get();

        self::assertStringContainsString("DELETE FROM users WHERE  name  LIKE 'John Doe' LIMIT 1", $sql);
    }

    public function testFind() {
        $sql = PostreSQLBuilder::find("cities")->get();

        self::assertStringContainsString("SELECT * FROM cities", $sql);
    }

    public function testFindWithWhereClosure() {
        $sql = PostreSQLBuilder::find("cities", ["name" => "San Francisco"])->get();

        self::assertStringContainsString("SELECT * FROM cities WHERE  name  LIKE 'San Francisco'", $sql);
    }

    public function testOrderBy() {
        $sql = PostreSQLBuilder::find("cities")->orderBy("name", Order::ASCENDING)->get();

        self::assertStringContainsString("SELECT * FROM cities ORDER BY name ASC", $sql);
    }

    public function testSave() {
        $object = new stdClass();

        $object->name = "Berlin";

        $sql = PostreSQLBuilder::save("cities", $object)->get();

        self::assertStringContainsString("INSERT INTO cities(name) VALUES ('Berlin')", $sql);
    }

    public function testUpdate() {
        $sql = PostreSQLBuilder::update("cities", ["name" => "New York City"], ["name" => "NYC"])->get();

        self::assertStringContainsString("UPDATE cities SET  name = New York City WHERE  name  LIKE 'NYC'", $sql);
    }

    public function testOffset() {
        $sql = PostreSQLBuilder::find("cities", ['name' => "N%"])->offset(5)->get();

        self::assertStringContainsString("SELECT * FROM cities WHERE  name  LIKE 'N%' OFFSET 5", $sql);
    }

    public function testOffsetWithLimit() {
        $sql = PostreSQLBuilder::find("cities", ['name' => "N%"])->limit(5)->offset(5)->get();

        self::assertStringContainsString("SELECT * FROM cities WHERE  name  LIKE 'N%' LIMIT 5  OFFSET 5", $sql);
    }
}
