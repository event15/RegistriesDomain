<?php

namespace spec\Madkom\Registries\Domain\Car\Term;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CarTermCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Car\Term\CarTermCollection');
    }
}
