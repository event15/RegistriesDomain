<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 02.12.15
 * Time: 14:43
 */

namespace Madkom\RegistryApplication\Domain\CarManagement;

interface CarRepositoryInterface
{
    public function save(Car $car);
}