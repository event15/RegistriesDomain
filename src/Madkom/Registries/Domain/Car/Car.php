<?php
/**
 * Created by PhpStorm.
 * User: sczarnop
 * Date: 07.08.15
 * Time: 15:50
 */

namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Car\Term\CarTermCollection;
use Madkom\Registries\Domain\Position;
use Madkom\Registries\Domain\Term;

/**
 * Class Car
 * @package Madkom\Registries\Domain\Car
 */
class Car extends Position
{

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $registrationNumber;

    /** @var  integer */
    protected $registryId;

    /** @var  string */
    protected $others;

    public function __construct()
    {
        $this->terms = new CarTermCollection();
    }

    public function __toString()
    {
        return "Marka ='{$this->brand}', Model='{$this->model}', Numer='{$this->registrationNumber}'";
    }

    public function addTerm(Term $term)
    {
        $this->terms->addTerm($term);
    }

    public function removeTerm(Term $term)
    {
        $this->terms->removeTerm($term);
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function changeBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function changeModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param string $registrationNumber
     */
    public function changeRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return string
     */
    public function getOthers()
    {
        return $this->others;
    }

    /**
     * @param string $others
     */
    public function changeOthers($others)
    {
        $this->others = $others;
    }
}
