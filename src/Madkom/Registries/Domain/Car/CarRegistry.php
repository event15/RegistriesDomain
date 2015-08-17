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
    public function addPos(Position $position)
    {
        $tmp = $this->positions;
        foreach($tmp as $pos) {
            $pos->addPosition($position);
        }

        //$tmp->addPosition($position);
        //$this->positions->addPosition($position);
    }
}
