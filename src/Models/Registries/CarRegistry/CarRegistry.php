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

/**
 * Class CarRegistry
 * @package Models\Registries\CarRegistry
 */
class CarRegistry extends Registry
{
    /** @var array $cars */
    private $cars = array();

    /**
     * @return string
     */
    public function getType()
    {
        return RegistryFactory::CAR_REGISTRY;
    }


}