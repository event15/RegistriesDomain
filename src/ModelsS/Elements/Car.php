<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models\Elements;

use Doctrine\Common\Collections\ArrayCollection;
use Models\DTO\CarElement;
use Models\ElementModel;

class Car extends ElementModel
{
    private $carId;//
    private $brand;
    private $model;//
    private $registrationNumber;//
    private $insurer;
    private $others;
    private $attachments;
    private $registryId;
    private $terms;//

    public function __construct(CarElement $metadata)
    {
        parent::__construct();
        $this->brand              = $metadata->brand;
        $this->model              = $metadata->model;
        $this->registrationNumber = $metadata->registrationNumber;
        $this->insurer            = $metadata->insurer;
        $this->others             = $metadata->others;
        $this->attachments        = $metadata->attachments;
        $this->registryId         = $metadata->registryId;
        $this->terms              = new ArrayCollection();
    }
    public function toArray()
    {
        return array(
            'id'                 => $this->carId,
            'brand'              => $this->brand,
            'model'              => $this->model,
            'registrationNumber' => $this->registrationNumber,
            'insurer'            => $this->insurer,
            'others'             => $this->others,
            'attachments'        => $this->attachments,
            'terms'              => $this->terms
        );
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param mixed $registrationNumber
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @param mixed $insurer
     */
    public function setInsurer($insurer)
    {
        $this->insurer = $insurer;
    }

    /**
     * @param mixed $others
     */
    public function setOthers($others)
    {
        $this->others = $others;
    }

    /**
     * @param mixed $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @param Term $term
     */
    public function addTerm(Term $term)
    {
        $this->terms[] = $term;
    }
}
