<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TermNotAllowedExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\TermNotAllowedException');
    }
}
