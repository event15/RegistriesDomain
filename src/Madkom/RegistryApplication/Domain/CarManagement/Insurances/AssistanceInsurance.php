<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

class AssistanceInsurance extends Insurance
{
    const INSURANCE_TYPE = 'ASS';

    public function getType()
    {
        return self::INSURANCE_TYPE;
    }
}
