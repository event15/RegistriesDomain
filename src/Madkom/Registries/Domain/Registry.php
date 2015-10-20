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
        if ($this->registryHasName($name)) {
            $this->changeName($name);
            $this->setCreateTime();
        }
    }

    private function registryHasName($name)
    {
        $name = trim($name);

        if ($name === null || $name === '') {
            throw new EmptyRegistryNameException('Registry name must have a value.');
        }

        return true;
    }

    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->name = $name;
    }

    private function setCreateTime()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function showPositions()
    {
        return $this->positions;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    abstract public function addPosition(Position $position);

    /**
     * @param Position $position
     *
     * @throws PositionNotFoundException
     */
    public function removePosition(Position $position)
    {
        $this->positions->removePosition($position);
    }

    abstract public function registryToArray();

    abstract public function getRegistryType();

}
