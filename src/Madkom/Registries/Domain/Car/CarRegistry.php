<?php
namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Position;
use Madkom\Registries\Domain\Registry;

/**
 * Class CarRegistry
 *
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
        /* To pozwalało dodać do returna wszystkie pozycje połączone z rejestrem
         * Można usunąć, ale warto widzieć zależność.
         *
         *
        $position = $this->showPositions();
        $x        = [];
        foreach ($position as $p) {
            $x[] = [
                'model' => $p->getModel()
            ];
        }*/

        return [
                'id'        => $this->id,
                'name'      => $this->name,
                'createdAt' => $this->createdAt
               ];
    }

    public function getRegistriesNamesToArray()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name
        ];
    }

    public function getRegistryType()
    {
        return self::TYPE_NAME;
    }

    public function addPosition(Position $position)
    {
        $this->positions->add($position);
    }
}
