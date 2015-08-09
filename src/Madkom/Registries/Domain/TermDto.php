<?php

namespace Madkom\Registries\Domain;

class TermDto
{
    /**
     * @var \DateTime
     */
    public $expiryDate;

    /**
     * @var \DateInterval
     */
    public $notifyBefore;

    /**
     * @var array
     */
    public $whoToNotify;
}
