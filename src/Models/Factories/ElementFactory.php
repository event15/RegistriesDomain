<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:30
 */

namespace Models\Factories;

use Models\Elements\Car;

class ElementFactory
{
    protected $registryType;

    const CAR_ELEMENT      = 'samochody';
    const POLICY_ELEMENT   = 'polisy';
    const DEPOSIT_ELEMENT  = 'wadium';

    public function create($registryType, $metadata)
    {
        switch ($registryType) {
            case self::CAR_ELEMENT:
                return new Car($metadata);
                break;
            default:
                return "Nie odnaleziono rejestru o typie '{$registryType}'";
                break;
        }
    }
}
