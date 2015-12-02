<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 18.11.15
 * Time: 15:32
 */
namespace Madkom\RegistryApplication\Application\CarManagement\Command;

use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Domain\CarManagement\Car;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarRepository;

class AddCarCommand implements CommandInterface
{
    private $preparedCar;
    private $carRepository;


    public function __construct(CarDTO $preparedCar, CarRepository $carRepository)
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
            new \DateTime($this->preparedCar->productionDate),
            new \DateTime($this->preparedCar->warrantyPeriod),
            $this->preparedCar->city,
            $this->preparedCar->department
        );

        $this->carRepository->save($car);
    }
}