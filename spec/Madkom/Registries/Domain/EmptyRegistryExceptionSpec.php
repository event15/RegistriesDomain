<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 07.09.15
 * Time: 11:53
 */

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;

class EmptyRegistryExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\EmptyRegistryException');
    }
}
