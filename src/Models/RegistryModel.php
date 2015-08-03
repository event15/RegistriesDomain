<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models;


use Models\Factories\ElementFactory;

abstract class RegistryModel
{
    private $id;
    private $name;
    private $createDate;
    private $type;

    public function __construct($name)
    {
        $this->name = $name;
        $this->createDate = new \DateTime('now');
        echo "RegistryModel";
    }
}