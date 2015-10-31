<?php

namespace spec\Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\Car\Term\ASS;
use Madkom\Registries\Domain\Car\Term\OC;
use Madkom\Registries\Domain\Car\Term\Review;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\TermDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TermFactorySpec
 *
 * @package spec\Madkom\Registries\Domain
 * @mixin \Madkom\Registries\Domain\TermFactory
 */
class TermFactorySpec extends ObjectBehavior
{
    private $termDto;
    private $bad_type = 'very nasty type';

    public function let()
    {
        $this->createNewTerm('Dział handlowy', 'handl@ujmy.pl');
    }

    private function createNewTerm($departmentName, $departmentEmail)
    {
        $this->termDto               = new TermDto();
        $this->termDto->expiryDate   = new \DateTime('now');
        $this->termDto->notifyBefore = new \DateTime('now');
        $this->termDto->whoToNotify  = new DepartmentCollection();
        $this->termDto->whoToNotify->add($departmentName, $departmentEmail);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Domain\TermFactory');
    }

    public function it_should_return_instance_of_AC_for_term()
    {
        $expectedTermType = AC::TYPE;

        $this->create($expectedTermType, $this->termDto)
             ->shouldReturnAnInstanceOf('Madkom\Registries\Domain\Car\Term\AC');
    }

    public function it_should_return_instance_of_OC_for_term()
    {
        $expectedTermType = OC::TYPE;

        $this->create($expectedTermType, $this->termDto)
             ->shouldReturnAnInstanceOf('Madkom\Registries\Domain\Car\Term\OC');
    }

    public function it_should_return_instance_of_ASS_for_term()
    {
        $expectedTermType = ASS::TYPE;

        $this->create($expectedTermType, $this->termDto)
             ->shouldReturnAnInstanceOf('Madkom\Registries\Domain\Car\Term\ASS');
    }

    public function it_should_return_instance_of_Review_for_term()
    {
        $expectedTermType = Review::TYPE;

        $this->create($expectedTermType, $this->termDto)
             ->shouldReturnAnInstanceOf('Madkom\Registries\Domain\Car\Term\Review');
    }

    public function it_should_throw_an_UnknownTermTypeException_for_bad_term_type(TermDto $termDto)
    {
        $this->shouldThrow('Madkom\Registries\Domain\UnknownTermTypeException')
             ->during('create', [$this->bad_type, $termDto]);
    }
}
