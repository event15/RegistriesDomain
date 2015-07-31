<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:28
 */

namespace Models\Registries\CarRegistry;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Car
 * @package Models\Registries\CarRegistry
 */
class Car
{
    /** @var  integer $carId */
    private $carId;

    /** @var  string $brand */
    private $brand;

    /** @var  string $model */
    private $model;

    /** @var  string $registrationNumber */
    private $registrationNumber;

    /** @var  string $insurer */
    private $insurer;

    /** @var  string $others */
    private $others;

    /** @var  string $attachments */
    private $attachments;

    /** @var  string $createdBy */
    private $createdBy;

    /** @var  integer $registryId */
    private $registryId;

    /** @var ArrayCollection  $terms */
    private $terms;

    /**
     * @param array $metadata
     */
    public function __construct($metadata)
    {
        $this->brand = $metadata[0];
        $this->model = $metadata[1];
        $this->registrationNumber = $metadata[2];
        $this->insurer = $metadata[3];
        $this->others = $metadata[4];
        $this->attachments = $metadata[5];
        $this->createdBy = $metadata[6];
        $this->registryId = $metadata[7];
        $this->terms = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCarId()
    {
        return $this->carId;
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
     * @return string
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * @return string
     */
    public function getOthers()
    {
        return $this->others;
    }

    /**
     * @return string
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return int
     */
    public function getRegistryId()
    {
        return $this->registryId;
    }

    /**
     * @return ArrayCollection
     */
    public function getTerms()
    {
        return $this->terms;
    }

    public function toArray()
    {
        return array(
            'id' => $this->carId,
            'brand' => $this->brand,
            'model' => $this->model,
            'registration_number' => $this->registrationNumber,
            'insurer' => $this->insurer,
            'others' => $this->others,
            'attachments' => $this->attachments,
            'terms' => $this->terms,
        );
    }

}