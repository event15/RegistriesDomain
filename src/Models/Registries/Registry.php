<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 13:27
 */

namespace Models\Registries;

abstract class Registry
{
    /**
     * @var int
     */
    protected $registryId;
    /**
     * @var string
     */
    protected $registryName;

    protected $createdBy;

    /**
     * @var \DateTime
     */
    protected $createDate;

    protected $registerType;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->registryName = $name;
        $this->createDate = new \DateTime();
    }

    /**
     * @return string
     */
    public abstract function getType();


    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->registryName = $name;
    }

    public function showDate($formatDate)
    {
        return $this->createDate->format ($formatDate);
    }

    public function toArray()
    {
        $registry = array( 'registry_id' => $this->registryId,
               'registry_name' => $this->registryName,
               'registerType' => $this->getType(),
               'registry_created_by' => $this->createdBy,
               'registry_create_date' => $this->createDate->format('Y-m-d H:i:s')
            );

        return $registry;
    }


}