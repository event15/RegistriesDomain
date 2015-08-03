<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models\Elements;


use Models\ElementModel;

class Car extends ElementModel
{
    private $carId;
    private $brand;
    private $model;
    private $registrationNumber;
    private $insurer;
    private $others;
    private $attachments;
    private $createdBy;
    private $registryId;
    private $terms;

    private $metadata = [];

    public function __construct(array $ok)
    {
        array_push($this->metadata, $ok);
    }

    public function getMetadata()
    {
        return $this->metadata;
    }
    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;
    }
    public function toArray()
    {
        $this->metadata = array(
            'id' => $this->carId,
            'brand' => $this->brand,
            'model' => $this->model,
            'registrationNumber' => $this->registrationNumber,
            'insurer' => $this->insurer,
            'others' => $this->others,
            'attachments' => $this->attachments,
            'createdBy' => $this->createdBy,
            'registryId' => $this->registryId,
            'terms' => $this->terms
        );
    }
}