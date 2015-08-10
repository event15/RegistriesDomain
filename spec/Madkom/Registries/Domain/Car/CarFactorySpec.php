<?php

namespace spec\Madkom\Registries\Domain\Car;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CarFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Car\CarFactory');
    }
}
