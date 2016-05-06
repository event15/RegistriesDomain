<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

class InsuranceDateChecker
{
    public function checkDates(\DateTime $dateFrom, \DateTime $dateTo)
    {
        return ($dateFrom >= $dateTo) ?: false;
    }
}
