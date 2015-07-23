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
     * Registry constructor.
     * @param string $name
     */
    public function __construct($name, $createdBy)
    {
        $this->name = $name;
        $this->createdBy = $createdBy;
        $this->createDate = new \DateTime();
    }

    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->name = $name;
    }

    public function showDate($formatDate)
    {
        return $this->createDate->format($formatDate);
    }

}