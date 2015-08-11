<?php
namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Registry;

/**
 * Class CarRegistry
 * @package Madkom\Registries\Domain\Car
 */
class CarRegistry extends Registry
{

    const TYPE_NAME = 'car';

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);
        $this->positions = new CarCollection();
    }
}
