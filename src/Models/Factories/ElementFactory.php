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

    const CAR_ELEMENT      = 'samochod';
    const POLICY_ELEMENT   = 'polisa';
    const DEPOSIT_ELEMENT  = 'wadium';

    public function create($registryType, $name)
    {
        switch ($registryType) {
            case self::CAR_ELEMENT:
                return new Car($name);
                break;
            default:
                return "Nie odnaleziono rejestru o typie '{$registryType}'";
                break;
        }
    }
}