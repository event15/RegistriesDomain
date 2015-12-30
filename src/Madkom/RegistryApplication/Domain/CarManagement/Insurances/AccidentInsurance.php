<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

class AccidentInsurance extends Insurance
{
    const INSURANCE_TYPE = 'NWW';

    public function getType()
    {
        return self::INSURANCE_TYPE;
    }
}
