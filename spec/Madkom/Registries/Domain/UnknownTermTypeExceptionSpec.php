<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownTermTypeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\UnknownTermTypeException');
    }
}
