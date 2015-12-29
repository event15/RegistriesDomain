<?php

namespace spec\Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class InsuranceFactorySpec
 *
 * @package spec\Madkom\RegistryApplication\Domain\CarManagement\Insurances
 * @mixin \Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceFactory
 */
class InsuranceFactorySpec extends ObjectBehavior
{
    const   INSURANCES_PATH = 'Madkom\RegistryApplication\Domain\CarManagement\Insurances';
    private $dateFrom;
    private $dateTo;

    public function let()
    {
        $this->dateFrom = new \DateTime('01-12-2015');
        $this->dateTo   = new \DateTime('01-12-2016');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(self::INSURANCES_PATH . '\InsuranceFactory');
    }

    public function it_should_return_a_valid_Insurance_when_all_arguments_is_valid()
    {
        $insuranceTypes = [
            'AC'  => self::INSURANCES_PATH . '\CarInsurance',
            'NWW' => self::INSURANCES_PATH . '\AccidentInsurance',
            'OC'  => self::INSURANCES_PATH . '\LiabilityInsurance',
            'ASS' => self::INSURANCES_PATH . '\AssistanceInsurance'
        ];

        $insuranceId = '321-321-321';
        $insurerId   = '123-123-123';

        foreach ($insuranceTypes as $insuranceType => $insuranceTypeClass) {
            $this->create($insuranceId, $insuranceType, $this->dateFrom, $this->dateTo, $insurerId)
                 ->shouldReturnAnInstanceOf($insuranceTypeClass);
        }
    }

    public function it_should_throw_UnknownInsuranceTypeException_when_Insurance_type_is_unknown()
    {
        $emptyInsuranceType = '';
        $nullInsuranceType  = null;
        $insuranceId        = '321-321-321';
        $insurerId          = '123-123-123';

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException')
             ->during('create', [$insuranceId, $emptyInsuranceType, $this->dateFrom, $this->dateTo, $insurerId]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException')
             ->during('create', [$insuranceId, $nullInsuranceType, $this->dateFrom, $this->dateTo, $insurerId]);

    }

    public function it_should_throw_InvalidArgumentException_when_dateFrom_or_dateTo_are_empty()
    {
        $validInsuranceType = 'OC';
        $insuranceId        = '321-321-321';
        $insurerId          = '123-123-123';

        $emptyDateFrom = '';
        $emptyDateTo   = '';

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException')
             ->during('create', [$insuranceId, $validInsuranceType, $emptyDateFrom, $this->dateTo, $insurerId]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException')
             ->during('create', [$insuranceId, $validInsuranceType, $this->dateFrom, $emptyDateTo, $insurerId]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException')
             ->during('create', [$insuranceId, $validInsuranceType, $emptyDateFrom, $emptyDateTo, $insurerId]);

    }

    public function it_should_throw_InvalidArgumentException_when_dateFrom_or_dateTo_are_invalid()
    {
        $validInsuranceType      = 'OC';
        $insuranceId             = '321-321-321';
        $insurerId               = '123-123-123';
        $invalidDateFromInstance = '11-01-2015';
        $invalidDateToInstance   = '11-01-2016';

        $this->shouldThrow('\InvalidArgumentException')
             ->during('create', [$insuranceId, $validInsuranceType, $invalidDateFromInstance, $invalidDateToInstance, $insurerId]);
    }

    public function it_should_throw_InvalidDatesException_when_dateFrom_is_greater_than_or_equal_to_dateTo()
    {
        $validInsuranceType        = 'OC';
        $insuranceId               = '321-321-321';
        $insurerId                 = '123-123-123';
        $dateFromGreaterThanDateTo = new \DateTime('11-01-2016');
        $isEqualToDateTo           = new \DateTime('11-01-2015');
        $dateTo                    = new \DateTime('11-01-2015');

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException')
             ->during('create', [$insuranceId, $validInsuranceType, $dateFromGreaterThanDateTo, $dateTo, $insurerId]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException')
             ->during('create', [$insuranceId, $validInsuranceType, $isEqualToDateTo, $dateTo, $insurerId]);
    }
}
