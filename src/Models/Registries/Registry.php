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
    protected $name;

    /**
     * @var \DateTime
     */
    protected $createDate;


    /**
     * Registry constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->createDate = new \DateTime();
    }

    /**
     * @param $name
     */
    public function changeName($name)
    {
        $this->name = $name;
    }

}