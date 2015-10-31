<?php

namespace Madkom\Registries\Domain;

/**
 * Class PositionFactory
 *
 * @package Madkom\Registries\Domain
 */
class PositionFactory
{

    /**
     * @var PositionCreateStrategy
     */
    protected $positionCreateStrategy;

    /**
     * @param PositionCreateStrategy $positionCreateStrategy
     */
    public function __construct(PositionCreateStrategy $positionCreateStrategy)
    {
        $this->positionCreateStrategy = $positionCreateStrategy;
    }

    /**
     * @param PositionDto $positionDto
     *
     * @throws PositionTypeNotAllowedException
     * @return Position
     */
    public function create(PositionDto $positionDto)
    {
        return $this->positionCreateStrategy->create($positionDto);
    }
}