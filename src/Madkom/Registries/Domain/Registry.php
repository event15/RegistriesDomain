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
    protected $id;

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

    /**
     * Registry constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }

    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Position $position
     * @throws PositionNotAllowedException
     */
    public function addPosition(Position $position)
    {
        $this->positions->addPosition($position);
    }

    /**
     * @param Position $position
     * @throws PositionNotFoundException
     */
    public function removePosition(Position $position)
    {
        $this->positions->removePosition($position);
    }

    public function toArray()
    {
        return array(
            'id'        => $this->id,
            'name'      => $this->name,
            'createdAt' => $this->createdAt,
            'positions' => $this->positions,
        );
    }
}
