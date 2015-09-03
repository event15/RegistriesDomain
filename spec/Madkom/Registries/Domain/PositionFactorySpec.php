<?php

namespace spec\Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Car;
use Madkom\Registries\Domain\Car\CarDto;
use Madkom\Registries\Domain\PositionCreateStrategy;
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

    public function it_should_return_Car_type_when_PositionDto_is_a_CarDto(
        PositionCreateStrategy $positionCreateStrategy,
        CarDto                 $positionDto,
        Car                    $car
    ) {
        $positionCreateStrategy->create($positionDto)->willReturn($car);
    }
}
