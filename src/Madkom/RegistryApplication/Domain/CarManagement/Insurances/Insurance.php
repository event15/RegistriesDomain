<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\NonexistentInsuranceException;

/**
 * Class Insurance
 *
 * @package Madkom\RegistryApplication\Domain\CarManagement\Insurances
 */
class Insurance
{
    /** @var  string $insuranceId */
    private $insuranceId;

    /** @var  \DateTime */
    private $dateFrom;

    /** @var  \DateTime */
    private $dateTo;

    /** @var  string */
    private $insurerId;

    /** @var  \Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceDocument[] */
    private $documents = [];

    /** @var  string */
    private $insuranceCoverage;

    /**
     * Insurance constructor.
     *
     * @param $dateFrom
     * @param $dateTo
     * @param $insurerId
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     */
    public function __construct($insuranceId, $dateFrom, $dateTo, $insurerId)
    {
        $dateChecker    = new InsuranceDateChecker();
        $isInvalidDates = $dateChecker->checkDates($dateFrom, $dateTo);

        if ($isInvalidDates) {
            throw new InvalidDatesException();
        }

        $this->dateFrom    = $dateFrom;
        $this->dateTo      = $dateTo;
        $this->insurerId   = $insurerId;
        $this->insuranceId = $insuranceId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->insuranceId;
    }

    /**
     * @return \Madkom\RegistryApplication\Domain\Insurer\Insurer
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\EmptyInsurerException
     */
    public function getInsurer()
    {
        return $this->insurerId;
    }

    /**
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @return string
     */
    public function getInsuranceCoverage()
    {
        return $this->insuranceCoverage;
    }

    public function addInsuranceDocument(InsuranceDocument $newCarDocument)
    {
        $this->documents[] = $newCarDocument;
    }

    public function getInsuranceDocuments()
    {
        return $this->documents;
    }

    public function removeInsuranceDocument($documentId)
    {
        foreach ($this->documents as $key => $document) {
            if ($document->getId() === $documentId) {
                unset($this->documents[$key]);

                return 0;
            }
        }

        throw new NonexistentInsuranceException();
    }

    public function changeInsuranceCoverage($coverage)
    {
        $this->insuranceCoverage = $coverage;
    }

}
