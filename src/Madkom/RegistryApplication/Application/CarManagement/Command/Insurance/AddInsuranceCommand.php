<?php

namespace Madkom\RegistryApplication\Application\CarManagement\Command\Insurance;

use Madkom\RegistryApplication\Application\CarManagement\Command\CommandInterface;
use Madkom\RegistryApplication\Application\CarManagement\DocumentDTO;
use Madkom\RegistryApplication\Application\CarManagement\InsuranceDTO;
use Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceFactory;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;

/**
 * Class AddInsuranceCommand
 *
 * @package Madkom\RegistryApplication\Application\CarManagement\Command\Insurance
 */
final class AddInsuranceCommand implements CommandInterface
{
    /** @var  \Madkom\RegistryApplication\Application\CarManagement\InsuranceDTO $insuranceDTO */
    private $insuranceDTO;

    /** @var  \Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository $repository */
    private $repository;

    /** @var  \Madkom\RegistryApplication\Domain\CarManagement\Car $car */
    private $car;

    private $documentDTO;

    private $documentFile;

    private function __construct()
    {
    }

    public static function addWithFile(
        CarInMemoryRepository $repository,
        $carId,
        InsuranceDTO $insuranceDTO,
        DocumentDTO $documentDTO
    ) {
        $command              = new AddInsuranceCommand();
        $carInsuranceDocument = new DocumentFactory();

        $command->repository   = $repository;
        $command->insuranceDTO = $insuranceDTO;
        $command->documentDTO  = $documentDTO;
        $command->car          = $command->repository->find($carId);

        $command->documentFile = $carInsuranceDocument->create(DocumentFactory::INSURANCE_DOCUMENT,
                                                               $command->documentDTO->docId,
                                                               $command->documentDTO->title,
                                                               $documentDTO->description,
                                                               $documentDTO->source
        );

        return $command;
    }

    public static function add(CarInMemoryRepository $repository, $carId, InsuranceDTO $dto)
    {
        $command = new AddInsuranceCommand();

        $command->repository   = $repository;
        $command->insuranceDTO = $dto;
        $command->car          = $command->repository->find($carId);

        return $command;
    }

    public function execute()
    {
        $insurance        = $this->insuranceDTO;
        $insuranceFactory = new InsuranceFactory();
        $newInsurance     = $insuranceFactory->create($insurance->type,
                                                      new \DateTime($insurance->dateFrom),
                                                      new \DateTime($insurance->dateTo),
                                                      $insurance->insurerId
        );

        $this->car->addInsurance($newInsurance);
        if ($this->documentFile) {
            $this->car->addInsuranceDocument($newInsurance->getId(), $this->documentFile);
        }

        $this->repository->add($this->car);
    }
}