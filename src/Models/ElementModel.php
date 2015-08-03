<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 03.08.15
 * Time: 20:29
 */

namespace Models;


class ElementModel
{
    private $id;
    private $createDate;

    public function __construct()
    {
        $this->createDate = new \DateTime('Y');
        echo "ElementModel";
    }
}