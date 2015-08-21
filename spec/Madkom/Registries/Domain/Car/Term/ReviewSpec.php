<?php

namespace spec\Madkom\Registries\Domain\Car\Term;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReviewSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Car\Term\Review');
    }
}
