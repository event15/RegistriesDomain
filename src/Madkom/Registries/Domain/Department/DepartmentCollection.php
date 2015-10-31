<?php

namespace Madkom\Registries\Domain\Department;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DepartmentCollection
 *
 * @package Madkom\Registries\Domain\Department
 */
class DepartmentCollection extends ArrayCollection
{
    public function add($department)
    {
        parent::add($department);
    }

    public function removeElement($department)
    {
        parent::removeElement($department);
    }

    public function get($department)
    {
        parent::get($department);
    }
}
