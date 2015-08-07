<?php

namespace Madkom\Registries\Domain;

/**
 * Class Registry
 * @package Madkom\Registries\Domain
 */
abstract class Registry
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var PositionCollection
     */
    protected $positions;

}
