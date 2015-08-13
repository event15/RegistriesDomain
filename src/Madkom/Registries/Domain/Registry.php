<?php

namespace Madkom\Registries\Domain;

/**
 * Class Registry
 *
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
     * @param $name
     *
     * @throws EmptyRegistryNameException
     */
    public function __construct($name)
    {
        $name = trim($name);

        if ($name === null || $name === '' || $name === 0) {
            throw new EmptyRegistryNameException('Registry name must have a value.');
        }

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
    abstract public function RegistryToArray();

    abstract public function getRegistryType();
}
