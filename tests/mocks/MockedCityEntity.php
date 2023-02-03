<?php

namespace Hubert\PostgreSQLDriver\Tests\mocks;

use Avocado\ORM\Attributes\Field;
use Avocado\ORM\Attributes\Id;
use Avocado\ORM\Attributes\Table;

#[Table("cities")]
class
MockedCityEntity {

    public function __construct(
        #[Id]
        private int $id,
        #[Field]
        private string $name
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }
}