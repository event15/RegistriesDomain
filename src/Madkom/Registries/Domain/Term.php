<?php

namespace Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\CarCollection;
use Madkom\Registries\Domain\Department\DepartmentCollection;

/**
 * Class Term
 * @package Madkom\Registries\Domain\Term
 */
abstract class Term
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $expiryDate;

    /**
     * @var \DateTime
     */
    protected $notifyBefore;

    /**
     * @var DepartmentCollection
     */
    protected $whoToNotify;

    protected $cars;

    public function __construct()
    {
        $this->cars = new CarCollection();
    }

    /**
     * @return \DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @param \DateTime $expiryDate
     */
    public function changeExpiryDate(\DateTime $expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return \DateInterval
     */
    public function getNotifyBefore()
    {
        return $this->notifyBefore;
    }

    /**
     * @param \DateTime $notifyBefore
     */
    public function changeNotifyBefore(\DateTime $notifyBefore)
    {
        $this->notifyBefore = $notifyBefore;
    }

    /**
     * @return array
     */
    public function getWhoToNotify()
    {
        return $this->whoToNotify;
    }

    /**
     * @param DepartmentCollection $whoToNotify
     */
    public function changeWhoToNotify(DepartmentCollection $whoToNotify)
    {
        $this->whoToNotify = $whoToNotify;
    }

}
