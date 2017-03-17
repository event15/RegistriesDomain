<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException;

/**
 * Class InsuranceFactory.
 */
class InsuranceFactory
{
    /**
     * @param string $insuranceType
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string $insuranceId
     * @param string $insurerId
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsuranceDateException
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\UnknownInsuranceTypeException
     * @throws \InvalidArgumentException
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     *
     * @return Insurance
     */
    public function create($insuranceId, $insuranceType, $dateFrom, $dateTo, $insurerId)
    {
        $this->areEmpty($dateFrom, $dateTo);
        $this->hasValidDateFormat($dateFrom, $dateTo);
        $this->isEqualToOneYear($dateFrom, $dateTo);

        switch ($insuranceType) {
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
                throw new UnknownInsuranceTypeException('Unknown insurance type: '.$insuranceType);
                break;
        }

        return $insurance;
    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
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
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     *
     * @throws \InvalidArgumentException
     */
    private function hasValidDateFormat($dateFrom, $dateTo)
    {
        if (!($dateFrom instanceof \DateTime) or !($dateTo instanceof \DateTime)) {
            throw new \InvalidArgumentException('The \'date from\' or \'date to\' has not be instance of DateTime class.'
            );
        }
    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     */
    private function isEqualToOneYear($dateFrom, $dateTo)
    {
        $interval = $dateTo->diff($dateFrom);

        if ($interval->days < 365 or $interval->days > 366) {
            throw new InvalidDatesException('Umowa z ubezpieczeniem może być tylko na rok.');
        }
    }
}
