<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

class CarInsurance extends Insurance
{
    const INSURANCE_TYPE = 'AC';

    public function getType()
    {
        return self::INSURANCE_TYPE;
    }
}
