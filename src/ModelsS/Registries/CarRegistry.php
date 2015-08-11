<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:30
 */

namespace Models\Registries;

use Models\Elements\Car;
use Models\Factories\RegistryFactory;
use Models\RegistryModel;

class CarRegistry extends RegistryModel
{
    private $cars = [];

    public function __construct($name)
    {
        $this->registryName = $name;
        $this->createDate = new \DateTime('now');
        $this->registry_type = $this->getType();
    }

    public function getType()
    {
        return RegistryFactory::CAR_REGISTRY;
    }

    public function addCar(Car $car)
    {
        $this->cars[] = $car;
    }
}
