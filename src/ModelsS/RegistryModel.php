<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models;

abstract class RegistryModel
{
    protected $registryId;
    protected $registryName;
    /** @var  \DateTime */
    protected $createDate;
    protected $registry_type;

    /**
     * @return string
     */
    abstract public function getType();

    public function toArray()
    {
        return array(
            'id' => $this->registryId,
            'name' => $this->registryName,
            'createDate' => $this->createDate->format('Y-m-d H:i:s'),
            'type' => $this->getType()
            );
    }

    public function changeName($newName)
    {
        $this->registryName = $newName;
    }
}
