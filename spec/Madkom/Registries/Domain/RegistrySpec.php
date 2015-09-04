<?php

namespace spec\Madkom\Registries\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RegistrySpec
 *
 * @package spec\Madkom\Registries\Domain
 * @mixin \Madkom\Registries\Domain\Car\CarRegistry
 */
class RegistrySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('Madkom\Registries\Domain\Car\CarRegistry');
        $this->beConstructedWith('Samochody 2015');
    }

    public function it_should_have_CarRegistry_type()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\Car\CarRegistry');
    }

    public function it_getRegistryType_should_be_equal_to_car_after_construction()
    {
        $this->getRegistryType()->shouldBeEqualTo('car');
    }
    public function it_getName_must_return_a_valid_name_of_current_registry()
    {
        $validName = 'Samochody 2015';
        $this->getName()->shouldBeEqualTo($validName);
    }

    public function it_registryToArray_should_return_an_array()
    {
        $this->registryToArray()->shouldBeArray();
        $this->registryToArray()->shouldHaveKey('id');
        $this->registryToArray()->shouldHaveKey('name');
        $this->registryToArray()->shouldHaveKey('createdAt');
        $this->registryToArray()->shouldHaveKey('positions');
    }

    public function it_should_throw_EmptyRegistryNameException_when_name_is_null()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow('Madkom\Registries\Domain\EmptyRegistryNameException')->duringInstantiation();
    }

    public function it_should_throw_EmptyRegistryNameException_when_name_is_empty()
    {
        $this->beConstructedWith('');
        $this->shouldThrow('Madkom\Registries\Domain\EmptyRegistryNameException')->duringInstantiation();
    }
}
