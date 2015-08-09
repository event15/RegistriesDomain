<?php

namespace Madkom\Registries\Domain;

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
     * @var \DateInterval
     */
    protected $notifyBefore;

    /**
     * @var array
     */
    protected $whoToNotify;

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
     * @param \DateInterval $notifyBefore
     */
    public function changeNotifyBefore(\DateInterval $notifyBefore)
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
     * @param array $whoToNotify
     */
    public function changeWhoToNotify($whoToNotify)
    {
        $this->whoToNotify = $whoToNotify;
    }



}
