<?php

namespace spec\Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Car;
use Madkom\Registries\Domain\PositionCreateStrategy;
use Madkom\Registries\Domain\PositionDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PositionFactorySpec extends ObjectBehavior
{
    public function let(PositionCreateStrategy $positionCreateStrategy)
    {
        $this->beConstructedWith($positionCreateStrategy);
    }

    public function itIsInitializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\PositionFactory');
    }

    public function itShouldReturnCar(
        PositionCreateStrategy $positionCreateStrategy,
        PositionDto $positionDto,
        Car $car
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $positionCreateStrategy->create($positionDto)->willReturn($car);
    }
}
