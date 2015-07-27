<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:28
 */

namespace Models\Registries\CarRegistry;
use Doctrine\Common\Collections\ArrayCollection;

class Car
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

    public function __construct($terms)
    {
        $this->terms = new ArrayCollection();
    }


}