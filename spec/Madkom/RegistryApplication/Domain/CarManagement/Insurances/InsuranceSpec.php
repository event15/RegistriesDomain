<?php

namespace spec\Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use Madkom\RegistryApplication\Domain\Insurer\Insurer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class InsuranceSpec
 *
 * @package spec\Madkom\RegistryApplication\Domain\CarManagement\Insurances
 * @mixin \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance
 */
class InsuranceSpec extends ObjectBehavior
{
    const EXCEPTION_PATH = 'Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions';


    public function let()
    {
        $dateFrom = new \DateTime('01-12-2014');
        $dateTo   = new \DateTime('01-12-2015');
        $insuranceId = '123-123-123';

        $this->beConstructedWith($dateFrom, $dateTo, $insuranceId);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance');
    }
}
