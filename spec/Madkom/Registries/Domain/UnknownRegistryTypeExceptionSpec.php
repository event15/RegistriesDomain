<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownRegistryTypeExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\UnknownRegistryTypeException');
    }
}
