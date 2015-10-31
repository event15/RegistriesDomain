<?php

namespace Madkom\Registries\Domain\Car;

use Doctrine\Common\Collections\ArrayCollection;
use Madkom\Registries\Domain\PositionCollection;
use Madkom\Registries\Domain\PositionNotAllowedException;

/**
 * Class CarCollection
 *
 * @package Madkom\Registries\Domain\Car
 */
class CarCollection extends ArrayCollection implements PositionCollection
{
    public function add($element)
    {
        if ($element instanceof Car) {
            parent::add($element);
        } else {
            throw new PositionNotAllowedException;
        }
    }
}
