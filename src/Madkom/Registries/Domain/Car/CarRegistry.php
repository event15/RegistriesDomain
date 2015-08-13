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
     * @param $name
     *
     * @throws \Madkom\Registries\Domain\EmptyRegistryNameException
     */
    public function __construct($name)
    {
        parent::__construct($name);
        $this->positions = new CarCollection();
    }

    public function RegistryToArray()
    {
        return array(
            'id'        => $this->id,
            'name'      => $this->name,
            'createdAt' => $this->createdAt,
            'positions' => $this->positions,
        );
    }

    public function getRegistryType()
    {
        return self::TYPE_NAME;
    }
}
