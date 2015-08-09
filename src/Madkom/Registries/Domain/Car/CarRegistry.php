<?php
namespace Madkom\Registries\Domain\Car;

/**
 * Class CarRegistry
 * @package Madkom\Registries\Domain\Car
 */
class CarRegistry extends \Madkom\Registries\Domain\Registry
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