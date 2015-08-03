<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:30
 */

namespace Models\Registries;


use Models\Factories\ElementFactory;
use Models\Factories\RegistryFactory;
use Models\RegistryModel;

class CarRegistry extends RegistryModel
{
    private $cars = [];

    public function getType()
    {
        return RegistryFactory::CAR_REGISTRY;
    }

    public function getMetadata()
    {
        return $this->cars;
    }
    public function setMetadata(array $metadata)
    {
        $this->cars = $metadata;
    }
}