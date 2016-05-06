<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 02.12.15
 * Time: 14:43.
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
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\Car
     */
    public function find($carId);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     *
     * @return bool
     */
    public function remove($carId);

    public function getAllPositions();
}
