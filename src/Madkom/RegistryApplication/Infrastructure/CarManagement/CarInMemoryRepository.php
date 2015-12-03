<?php

namespace Madkom\RegistryApplication\Infrastructure\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\Car;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface;

/**
 * Class CarInMemoryRepository
 *
 * @package Madkom\RegistryApplication\Infrastructure\CarManagement
 */
class CarInMemoryRepository implements CarRepositoryInterface
{
    private $repository = [];

    public function save(Car $car)
    {
        $this->repository[$car->getId()] = $car;
    }

    public function find($carId)
    {
        if(!array_key_exists($carId, $this->repository)) {
            throw new CarNotFoundException('Nie znaleziono samochodu o podanym id = ' . $carId);
        }

        return $this->repository[$carId];
    }

    public function isEmpty()
    {
        return (! count($this->repository)) ?: false;
    }

    public function remove($carId)
    {
        if(!array_key_exists($carId, $this->repository)) {
            throw new CarNotFoundException('Nie znaleziono samochodu o podanym id = ' . $carId);
        }

        unset($this->repository[$carId]);
        return 0;
    }

    public function getAllPositions()
    {
        return $this->repository;
    }
}