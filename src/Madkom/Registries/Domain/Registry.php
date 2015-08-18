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
        if ($this->RegistryHasName($name)) {

            $this->changeName($name);
            $this->setCreateTime();
        }
    }

    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->name = $name;
    }
    private function RegistryHasName($name)
    {
        $name = trim($name);

        if ($name === null || $name === '' || $name === 0) {
            throw new EmptyRegistryNameException('Registry name must have a value.');
        }
        return true;
    }

    private function setCreateTime()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getName()
    {
        return $this->name;
    }


//    public function addPosition(Position $position)
//    {
//        $this->positions->addPosition($position);
//    }

    abstract public function addPos(Position $position);

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
