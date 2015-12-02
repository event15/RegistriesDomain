<?php

namespace Madkom\RegistryApplication\Infrastructure\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\Car;
use Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface;

class CarInMemoryRepository implements CarRepositoryInterface
{
    private $repository = [];

    public function save(Car $car)
    {
        $this->repository[] = $car;
    }
}