<?php

namespace spec\Madkom\Registries\Domain\Department;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DepartmentCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Department\DepartmentCollection');
    }
}
