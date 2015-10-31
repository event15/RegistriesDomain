<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RegistryFactorySpec
 *
 * @package spec\Madkom\Registries\Domain
 * @mixin \Madkom\Registries\Domain\RegistryFactory
 */
class RegistryFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\RegistryFactory');
    }

    public function it_should_return_a_CarRegistry_type()
    {
        $this->create('car', 'Samochody 2015')
             ->shouldReturnAnInstanceOf('Madkom\\Registries\\Domain\\Car\\CarRegistry');
    }

    public function it_should_throw_an_exception_when_receive_bad_type()
    {
        $this->shouldThrow('Madkom\Registries\Domain\UnknownRegistryTypeException')
             ->duringcreate('bad_type', 'samochody');
    }

    public function it_should_throw_an_EmptyRegistryTypeException_when_receive_an_empty_type()
    {
        $this->shouldThrow('Madkom\Registries\Domain\EmptyRegistryTypeException')
             ->duringcreate('', 'samochody');
    }

    public function it_should_throw_an_EmptyRegistryNameException_when_receive_an_empty_name()
    {
        $this->shouldThrow('Madkom\Registries\Domain\EmptyRegistryNameException')
             ->duringcreate('car', '');
    }
}
