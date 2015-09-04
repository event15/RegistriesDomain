<?php

namespace Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\CarRegistry;

/**
 * Class RegistryFactory
 * @package Madkom\Registries\Domain
 */
class RegistryFactory
{
    /**
     * @param $type
     * @param $name
     *
     * @return CarRegistry
     * @throws EmptyRegistryTypeException
     * @throws UnknownRegistryTypeException
     */
    public function create($type, $name)
    {
        switch ($type) {
            case CarRegistry::TYPE_NAME:
                return new CarRegistry($name);
                break;
            case null:
                throw new EmptyRegistryTypeException('Registry type must have a value.');
                break;
            default:
                throw new UnknownRegistryTypeException('Unknown registry type: ' . $type);
                break;
        }
    }

}
