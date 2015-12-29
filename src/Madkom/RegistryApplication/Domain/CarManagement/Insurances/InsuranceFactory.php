<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException;

/**
 * Class InsuranceFactory
 *
 * @package Madkom\RegistryApplication\Domain\CarManagement\Insurance
 */
class InsuranceFactory
{
    /**
     * @param $insuranceType
     * @param $dateFrom
     * @param $dateTo
     * @param $insuranceId
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Insurances\AccidentInsurance|\Madkom\RegistryApplication\Domain\CarManagement\Insurances\AssistanceInsurance|\Madkom\RegistryApplication\Domain\CarManagement\Insurances\CarInsurance|\Madkom\RegistryApplication\Domain\CarManagement\Insurances\LiabilityInsurance
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException
     * @throws \InvalidArgumentException
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     */
    public function create($insuranceId, $insuranceType, $dateFrom, $dateTo, $insurerId)
    {
        $this->areEmpty($dateFrom, $dateTo);
        $this->hasValidDateFormat($dateFrom, $dateTo);
        $this->isEqualToOneYear($dateFrom, $dateTo);

        switch($insuranceType) {
            case CarInsurance::INSURANCE_TYPE:
                $insurance = new CarInsurance($insuranceId, $dateFrom, $dateTo, $insurerId);
                break;
            case AccidentInsurance::INSURANCE_TYPE:
                $insurance = new AccidentInsurance($insuranceId, $dateFrom, $dateTo, $insurerId);
                break;
            case AssistanceInsurance::INSURANCE_TYPE:
                $insurance = new AssistanceInsurance($insuranceId, $dateFrom, $dateTo, $insurerId);
                break;
            case LiabilityInsurance::INSURANCE_TYPE:
                $insurance = new LiabilityInsurance($insuranceId, $dateFrom, $dateTo, $insurerId);
                break;
            default:
                throw new UnknownInsuranceTypeException('Unknown insurance type: ' . $insuranceType);
                break;
        }

        return $insurance;
    }

    /**
     * @param $dateFrom
     * @param $dateTo
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException
     */
    private function areEmpty($dateFrom, $dateTo)
    {
        if ($dateFrom === '' or $dateTo === '') {
            throw new EmptyInsuranceDateException('The \'date from\' or \'date to\' is empty');
        }
    }

    /**
     * @param $dateFrom
     * @param $dateTo
     * @throws \InvalidArgumentException
     */
    private function hasValidDateFormat($dateFrom, $dateTo)
    {
        if (! ($dateFrom instanceof \DateTime) or ! ($dateTo instanceof \DateTime)) {
            throw new \InvalidArgumentException('The \'date from\' or \'date to\' has not be instance of DateTime class.'
            );
        }
    }

    private function isEqualToOneYear($dateFrom, $dateTo)
    {
        $interval = $dateTo->diff($dateFrom);

        if($interval->days < 365 or $interval->days > 366) {
            throw new InvalidDatesException('Umowa z ubezpieczeniem może być tylko na rok.');
        }
    }
}
