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
    /**
     * @param \Madkom\RegistryApplication\Domain\CarManagement\Car $car
     *
     * @return mixed
     */
    public function add(Car $car);

    /**
     * @param $carId
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Car
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     */
    public function find($carId);

    /**
     * @return boolean
     */
    public function isEmpty();

    /**
     * @return boolean
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     */
    public function remove($carId);

    public function getAllPositions();
}