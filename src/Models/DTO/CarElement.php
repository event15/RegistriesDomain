<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 05.08.15
 * Time: 12:40
 */

namespace Models\DTO;

class CarElement
{
    public $carId;
    public $brand;
    public $model;
    public $registrationNumber;
    public $insurer;
    public $others;
    public $attachments;
    public $registryId;
    public $terms;

    /**
     * CarElement constructor.
     *
     * @param $brand
     * @param $model
     * @param $registrationNumber
     * @param $insurer
     * @param $others
     * @param $attachments
     * @param $registryId
     */
    public function __construct($brand, $model, $registrationNumber, $insurer, $others, $attachments, $registryId)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->registrationNumber = $registrationNumber;
        $this->insurer = $insurer;
        $this->others = $others;
        $this->attachments = $attachments;
        $this->registryId = $registryId;
    }
}
