<?php

namespace Madkom\RegistryApplication\Application\CarManagement\Command\Car;

use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\CommandInterface;
use Madkom\RegistryApplication\Domain\CarManagement\Car;
use Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface;

class AddCarCommand implements CommandInterface
{
    private $preparedCar;
    private $carRepository;


    public function __construct(CarRepositoryInterface $carRepository, CarDTO $preparedCar)
    {
        $this->preparedCar   = $preparedCar;
        $this->carRepository = $carRepository;
    }

    public function execute()
    {
        $car = Car::createCustom(
            $this->preparedCar->id,
            $this->preparedCar->responsiblePerson,
            $this->preparedCar->model,
            $this->preparedCar->brand,
            $this->preparedCar->registrationNumber,
            $this->preparedCar->productionDate,
            $this->preparedCar->warrantyPeriod,
            $this->preparedCar->city,
            $this->preparedCar->department
        );

        $this->carRepository->add($car);
    }
}