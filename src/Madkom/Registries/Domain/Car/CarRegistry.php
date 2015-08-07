<?php
namespace Madkom\Registries\Domain\Car;

/**
 * Class CarRegistry
 * @package Madkom\Registries\Domain\Car
 */
class CarRegistry extends \Madkom\Registries\Domain\Registry
{

    public function __construct()
    {
        $this->positions = new CarCollection();
    }



}