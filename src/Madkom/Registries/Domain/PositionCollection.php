<?php
/**
 * Created by PhpStorm.
 * User: sczarnop
 * Date: 07.08.15
 * Time: 15:47
 */

namespace Madkom\Registries\Domain;

/**
 * Class PositionCollection
 * @package Madkom\Registries\Domain
 */
interface PositionCollection
{
    /**
     * @param Position $position
     * @throws PositionNotFoundException
     */
    public function removePosition(Position $position);

    /**
     * @param Position $position
     * @throws PositionNotAllowedException
     */
    public function addPosition(Position $position);

}