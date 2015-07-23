<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 12:11
 */

namespace Models\Registries;

use Models\Registries\CarRegistry\CarRegistry as CarRegistry;
use Models\Registries\PolicyRegistry\PolicyRegistry as PolicyRegistry;
use Models\Registries\DepositRegistry\DepositRegistry as DepositRegistry;

/**
 * Class RegistryFactory
 * @package Models\Registries
 */
class RegistryFactory
{
    protected $registryType;

    const CAR_REGISTRY = 'car';
    const POLICY_REGISTRY = 'policy';
    const DEPOSIT_REGISTRY = 'deposit'; // WADIUM

    /**
     * @param $name
     * @param $userId
     * @param $registryType
     * @return CarRegistry|DepositRegistry|PolicyRegistry|string
     */
    public function create($name, $registryType, $createBy)
    {
        switch ($registryType) {
            case self::CAR_REGISTRY:
                return new CarRegistry($name, $createBy);
                break;
            case self::DEPOSIT_REGISTRY:
                return new DepositRegistry($name);
                break;
            case self::POLICY_REGISTRY:
                return new PolicyRegistry($name);
                break;
            default:
                return 'Nie odnaleziono podanego rejestru.';
                break;

        }
    }
}