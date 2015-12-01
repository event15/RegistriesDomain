<?php

namespace Madkom\RegistryApplication\Domain\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\DuplicatedVehicleInspectionException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\NonexistentInsuranceException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\RemovingNonexistentElementException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceDocument;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspectionDateChecker;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspectionDuplicationChecker;

class Car
{
    /** @var  string */
    private $id;

    /** @var  string */
    private $model;

    /** @var  string */
    private $brand;

    /** @var  string */
    private $registrationNumber;

    /** @var  \DateTime */
    private $productionDate;

    /** @var  \DateTime */
    private $warrantyPeriod;

    /** @var  string */
    private $fuelType;

    /** @var  string */
    private $engineSize;

    /** @var  string */
    private $gearBox;

    /** @var  string */
    private $city;

    /** @var  string */
    private $department;

    /** @var  Insurance[] */
    private $insurances = [];

    /** @var  CarDocument[] */
    private $carDocuments = [];

    /** @var  VehicleInspection[] */
    private $vehicleInspection = [];

    /**
     * Car constructor.
     *
     * @param           $id
     * @param           $model
     * @param           $brand
     * @param           $registrationNumber
     * @param \DateTime $productionDate
     * @param \DateTime $warrantyPeriod
     * @param           $city
     * @param           $department
     */
    private function __construct(
        $id,
        $model,
        $brand,
        $registrationNumber,
        \DateTime $productionDate,
        \DateTime $warrantyPeriod,
        $city,
        $department
    ) {
            $this->id                 = $id;
            $this->model              = $model;
            $this->brand              = $brand;
            $this->registrationNumber = $registrationNumber;
            $this->productionDate     = $productionDate;
            $this->warrantyPeriod     = $warrantyPeriod;
            $this->city               = $city;
            $this->department         = $department;
    }

    /**
     * @param           $id
     * @param           $model
     * @param           $brand
     * @param           $registrationNumber
     * @param \DateTime $productionDate
     * @param \DateTime $warrantyPeriod
     * @param           $city
     * @param           $department
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Car
     */
    public static function createCustom(
        $id,
        $model,
        $brand,
        $registrationNumber,
        \DateTime $productionDate,
        \DateTime $warrantyPeriod,
        $city,
        $department
    ) {
        return new self(
            $id,
            $model,
            $brand,
            $registrationNumber,
            $productionDate,
            $warrantyPeriod,
            $city,
            $department
        );
    }

    public function addVehicleInspection(VehicleInspection $newVehicleInspection)
    {
        $duplicationChecker = new VehicleInspectionDuplicationChecker();
        $isDuplicated       = $duplicationChecker->checkForDuplicates($this->vehicleInspection, $newVehicleInspection);
        if($isDuplicated) {
            throw new DuplicatedVehicleInspectionException;
        }

        $dateChecker    = new VehicleInspectionDateChecker();
        $isInvalidDates = $dateChecker->checkDates($newVehicleInspection);
        if($isInvalidDates) {
            throw new InvalidDatesException;
        }

        $this->vehicleInspection[] = $newVehicleInspection;
    }

    /**
     * @param \Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection $vehicleInspection
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\RemovingNonexistentElementException
     */
    public function removeVehicleInspection(VehicleInspection $vehicleInspection)
    {
        if($key = in_array($vehicleInspection, $this->vehicleInspection, true) !== false) {
            unset($this->vehicleInspection[$key - 1]);
        } else {
            throw new RemovingNonexistentElementException;
        }
    }

    public function getVehicleInspection()
    {
        return $this->vehicleInspection;
    }

    public function addInsurance(Insurance $newInsurance)
    {
        foreach ($this->insurances as $insurance) {
            if(($newInsurance->getDateFrom() < $insurance->getDateTo()) &&
               ($newInsurance->getType() === $insurance->getType())
            ) {
                throw new \InvalidArgumentException;
            }
        }
        $this->insurances[] = $newInsurance;
    }

    public function removeInsurance(Insurance $selectedInsurance)
    {

            foreach ($this->insurances as &$insurance) {
                if ($insurance !== null) {
                    if ($insurance->getId() === $selectedInsurance->getId()) {
                        $insurance = null;
                    }
                } else {
                    throw new \InvalidArgumentException;
                }
            }
    }

    public function addInsuranceDocument($insuranceId, InsuranceDocument $insuranceDocument)
    {
        foreach ($this->insurances as &$insurance) {
            if($insurance->getId() === $insuranceId) {
                $insurance->addInsuranceDocument($insuranceDocument);
                return 0;
            }
        }

        throw new NonexistentInsuranceException('Nie odnaleziono wybranego ubezpieczenia.');
    }

    public function getInsuranceDocuments($insuranceId)
    {
        foreach ($this->insurances as &$insurance) {
            if($insurance->getId() === $insuranceId) {
                return $insurance->getInsuranceDocuments();
            }
        }

        throw new NonexistentInsuranceException('Nie odnaleziono wybranego ubezpieczenia.');
    }

    public function addCarDocument(CarDocument $carDocument)
    {
        $this->carDocuments[] = $carDocument;
    }

    public function removeCarDocument($carDocumentId)
    {

    }

    public function getCarDocument()
    {
        return $this->carDocuments;
    }

    public function removeInsuranceDocument()
    {

    }

    public function getInsurance()
    {
        return $this->insurances;
    }

    public function changeCity($city)
    {
        $this->city = $city;
    }

    public function changeDepartment($department)
    {
        $this->department = $department;
    }
}
