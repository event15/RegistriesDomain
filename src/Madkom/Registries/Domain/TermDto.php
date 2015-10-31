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
     * @var \DateTime
     */
    public $notifyBefore;

    /**
     * @var DepartmentCollection
     */
    public $whoToNotify;
}
