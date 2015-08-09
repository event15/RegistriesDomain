<?php

namespace Madkom\Registries\Domain;

use Madkom\Registries\Domain\Department\DepartmentCollection;

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
     * @var DepartmentCollection
     */
    public $whoToNotify;
}
