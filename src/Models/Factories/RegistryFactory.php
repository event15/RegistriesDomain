<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models\Factories;

use Models\Registries\CarRegistry;

class RegistryFactory
{
    protected $type;

    const CAR_REGISTRY      = 'samochody';
    const POLICY_REGISTRY   = 'polisy';
    const DEPOSIT_REGISTRY  = 'wadium';

    public function create($type, $name)
    {
        switch ($type) {
            case self::CAR_REGISTRY:
                return new CarRegistry($name);
                break;
            default:
                return "Nie odnaleziono rejestru o typie '{$type}'";
                break;
        }
    }
}
