<?php

namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\PositionCreateStrategy;
use Madkom\Registries\Domain\PositionDto;
use Madkom\Registries\Domain\PositionTypeNotAllowedException;

/**
 * Class CarFactory
 * @package Madkom\Registries\Domain\Car
 */
class CarFactory implements PositionCreateStrategy
{

    /**
     * @param PositionDto $positionDto
     * @return Car
     * @throws PositionTypeNotAllowedException
     */
    public function create(PositionDto $positionDto)
    {
        if ($positionDto instanceof CarDto) {
            $car = new Car();

            $car->changeBrand($positionDto->brand);
            $car->changeModel($positionDto->model);
            $car->changeRegistrationNumber($positionDto->registrationNumber);
            $car->changeOthers($positionDto->others);
            $car->setRegistryId($positionDto->registryId);

            return $car;
        }

        throw new PositionTypeNotAllowedException('This type is not allowed.');
    }
}
