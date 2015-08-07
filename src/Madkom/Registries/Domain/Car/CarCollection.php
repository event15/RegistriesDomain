<?php
/**
 * Created by PhpStorm.
 * User: sczarnop
 * Date: 07.08.15
 * Time: 15:53
 */

namespace Madkom\Registries\Domain\Car;


use Madkom\Registries\Domain\Position;
use Madkom\Registries\Domain\PositionCollection;

/**
 * Class CarCollection
 * @package Madkom\Registries\Domain\Car
 */
class CarCollection implements PositionCollection
{
    /**
     * @param Position $position
     * @return mixed
     */
    public function removeElement(Position $position)
    {
        // TODO: Implement removeElement() method.
    }

    /**
     * @param Position $position
     * @return mixed
     */
    public function addElement(Position $position)
    {
        // TODO: Implement addElement() method.
    }

}