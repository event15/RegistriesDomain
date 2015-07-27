<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 12:22
 */

namespace Models\Registries\CarRegistry;


use Models\Registries\Registry;
use Models\Registries\RegistryFactory;

class CarRegistry extends Registry
{
    /**
     * @var array
     */
    private $cars = array();

    public function getType()
    {
        return RegistryFactory::CAR_REGISTRY;
    }

}