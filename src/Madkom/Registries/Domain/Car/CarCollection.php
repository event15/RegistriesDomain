<?php

namespace Madkom\Registries\Domain\Car;


use Madkom\Registries\Domain\Position;
use Madkom\Registries\Domain\PositionCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Madkom\Registries\Domain\PositionNotAllowedException;

/**
 * Class CarCollection
 * @package Madkom\Registries\Domain\Car
 */
class CarCollection extends ArrayCollection implements PositionCollection
{
    /**
     * @param Position $position
     * @throws PositionNotAllowedException
     */
    public function removePosition(Position $position)
    {
        parent::removeElement($position);
    }

    /**
     * @param Position $position
     * @throws PositionNotAllowedException
     */
    public function addPosition(Position $position)
    {
        if($position instanceof Car)
        {
            $this->add($position);
        }
        else
        {
            throw new PositionNotAllowedException;
        }


    }

}