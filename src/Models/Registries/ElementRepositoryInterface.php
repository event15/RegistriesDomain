<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 21:50
 */

namespace Models\Registries;


use Models\Registries\CarRegistry\Car;
use Models\Registries\CarRegistry\CarRegistry;

interface ElementRepositoryInterface
{
    public function save(Car $registry);
    public function find($element);
    public function findAll();
    public function deleteOne(Car $car);
}