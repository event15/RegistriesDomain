<?php

namespace spec\Madkom\Registries\Domain\Department;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DepartmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Department\Department');
    }
}
