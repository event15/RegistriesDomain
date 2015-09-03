<?php
namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Position;
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
        $this->positions = new CarCollection();
        parent::__construct($name);
    }

    public function registryToArray()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'createdAt' => $this->createdAt,
            'positions' => $this->positions
        ];
    }

    public function getRegistryType()
    {
        return self::TYPE_NAME;
    }
    public function addPos(Position $position)
    {
        $this->positions = new CarCollection();
        $tmp = $this->positions;

        foreach ($tmp as $pos) {
            $pos->addPosition($position);
        }
    }
}
