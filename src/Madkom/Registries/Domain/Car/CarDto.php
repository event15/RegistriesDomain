<?php

namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\PositionDto;

/**
 * Class CarDto
 * @package Madkom\Registries\Domain\Car
 */
class CarDto extends PositionDto
{
    /**
     * @var string
     */
    public $brand;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $registrationNumber;

    /** @var  string */
    public $others;

    public $registryId;
}
