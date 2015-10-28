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
 *
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

    public function addTerm(Term $term)
    {
        $this->terms->add($term);
    }

    public function removeTerm(Term $term)
    {
        $this->terms->removeTerm($term);
    }

    /**
     * @param string $brand
     */
    public function changeBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param string $model
     */
    public function changeModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param string $registrationNumber
     */
    public function changeRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @param string $others
     */
    public function changeOthers($others)
    {
        $this->others = $others;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @return int
     */
    public function getRegistryId()
    {
        return $this->registryId;
    }

    /**
     * @return int
     */
    public function setRegistryId($registryId)
    {
        $this->registryId = $registryId;
    }

    /**
     * @return string
     */
    public function getOthers()
    {
        return $this->others;
    }

    public function showMetadata()
    {
        /** @var array $terms */
        $terms = $this->getTerms();

        $termTemp = $this->prepareTermsArray($terms);

        return [
            'id'                 => $this->id,
            'brand'              => $this->brand,
            'model'              => $this->model,
            'registrationNumber' => $this->registrationNumber,
            'others'             => $this->others,
            'terms'              => $termTemp
        ];
    }

    private function prepareTermsArray($terms)
    {
        $termTemp = [];


        foreach ($terms as $term) {
            $dep = $term->getWhoToNotify();

            $termTemp[] = [
                'expirationDate'     => $term->getExpiryDate(),
            ];
        }

        return $termTemp;
    }


}
