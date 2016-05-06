<?php

namespace spec\Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use PhpSpec\ObjectBehavior;

/**
 * Class InsuranceSpec.
 *
 * @mixin \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance
 */
class InsuranceSpec extends ObjectBehavior
{
    const EXCEPTION_PATH = 'Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions';

    public function let()
    {
        $dateFrom = new \DateTime('01-12-2014');
        $dateTo = new \DateTime('01-12-2015');
        $insuranceId = '321-321-321';
        $insurerId = '123-123-123';

        $this->beConstructedWith($insuranceId, $dateFrom, $dateTo, $insurerId);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance');
    }

    public function it_is_possible_to_change_Coverage_for_Insurance()
    {
        $this->changeInsuranceCoverage('Zakres, który obejmuje ubezpieczenie');
        $this->getInsuranceCoverage()->shouldReturn('Zakres, który obejmuje ubezpieczenie');
    }

    public function it_should_be_possible_to_get_InsurerId()
    {
        $this->getInsurer()->shouldReturn('123-123-123');
    }
}
