<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

class LiabilityInsurance extends Insurance
{
    const INSURANCE_TYPE = 'OC';

    public function getType()
    {
        return self::INSURANCE_TYPE;
    }
}

