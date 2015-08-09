<?php

namespace Madkom\Registries\Domain;

/**
 * Interface PositionCreateStrategy
 * @package Madkom\Registries\Domain
 */
interface PositionCreateStrategy
{

    /**
     * @param PositionDto $positionDto
     * @throws PositionTypeNotAllowedException
     * @return Position
     */
    public function create(PositionDto $positionDto);

}
