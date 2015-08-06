<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models\Elements;

use Models\DTO\CarElement;
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
    private $registryId;
    private $terms;

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
            'attachments'        => $this->attachments
        );
    }
}
