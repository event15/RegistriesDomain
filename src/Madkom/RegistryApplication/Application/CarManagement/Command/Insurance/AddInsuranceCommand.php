<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 08.12.15
 * Time: 15:42
 */

namespace Madkom\RegistryApplication\Application\CarManagement\Command\Insurance;

use Madkom\RegistryApplication\Application\CarManagement\Command\CommandInterface;
use Madkom\RegistryApplication\Application\CarManagement\InsuranceDTO;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceFactory;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;

class AddInsuranceCommand implements CommandInterface
{
    private $dto;
    private $repository;
    private $car;

    public function __construct(CarInMemoryRepository $repository, $carId, InsuranceDTO $dto)
    {
        $this->repository = $repository;
        $this->dto        = $dto;
        $this->car        = $this->repository->find($carId);
    }

    public function execute()
    {
        $meta = $this->dto;
        $insuranceFactory = new InsuranceFactory();
        $newInsurance = $insuranceFactory->create($meta->type,
                                                  new \DateTime($meta->dateFrom),
                                                  new \DateTime($meta->dateTo),
                                                  $meta->insurerId
        );
        $this->car->addInsurance($newInsurance);

        $this->repository->save($this->car);
    }
}