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
     * @param $terms
     */
    public function __construct($terms)
    {
        $this->terms = new ArrayCollection();
    }


}