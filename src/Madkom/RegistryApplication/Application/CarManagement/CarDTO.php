<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 02.12.15
 * Time: 15:36
 */

namespace Madkom\RegistryApplication\Application\CarManagement;

class CarDTO
{
    public $id;
    public $responsiblePerson;
    public $model;
    public $brand;
    public $registrationNumber;
    public $productionDate;
    public $warrantyPeriod;
    public $city;
    public $department;

    /**
     * CarDTO constructor.
     *
     * @param $id
     * @param $responsiblePerson
     * @param $model
     * @param $brand
     * @param $registrationNumber
     * @param $productionDate
     * @param $warrantyPeriod
     * @param $city
     * @param $department
     */
    public function __construct(
        $id,
        $responsiblePerson,
        $model,
        $brand,
        $registrationNumber,
        $productionDate,
        $warrantyPeriod,
        $city,
        $department
    ) {
        $this->id                 = $id;
        $this->responsiblePerson  = $responsiblePerson;
        $this->model              = $model;
        $this->brand              = $brand;
        $this->registrationNumber = $registrationNumber;
        $this->productionDate     = $productionDate;
        $this->warrantyPeriod     = $warrantyPeriod;
        $this->city               = $city;
        $this->department         = $department;
    }

}