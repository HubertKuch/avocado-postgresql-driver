<?php

namespace Hubert\PostgreSQLDriver\Tests\Mapper;

use Avocado\ORM\AvocadoModel;
use Avocado\ORM\AvocadoModelException;
use Hubert\PostgreSQLDriver\Mapper\PostreSQLMapper;
use Hubert\PostgreSQLDriver\Tests\mocks\MockedCityEntity;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use stdClass;

class PostreSQLMapperTest extends TestCase {

    /**
     * @throws AvocadoModelException
     * @throws ReflectionException
     */
    public function testEntityToObject() {
        $mapper = new PostreSQLMapper();
        $stdObject = new stdClass();

        $stdObject -> id = 5;
        $stdObject -> name = "Boston";

        $entityInstance = $mapper->entityToObject(new AvocadoModel(MockedCityEntity::class), $stdObject);

        self::assertTrue($entityInstance instanceof MockedCityEntity);
        self::assertEquals(5, $entityInstance->getId());
        self::assertEquals("Boston", $entityInstance->getName());
    }
}
