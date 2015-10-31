<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PositionSpec extends ObjectBehavior
{
    public function it_be_an_instance_of_Car()
    {
        $this->beAnInstanceOf('Madkom\Registries\Domain\Car');
    }
}
