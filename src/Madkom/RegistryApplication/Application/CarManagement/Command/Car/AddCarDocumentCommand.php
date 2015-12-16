<?php

namespace Madkom\RegistryApplication\Application\CarManagement\Command\Car;

use Madkom\RegistryApplication\Application\CarManagement\DocumentDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\CommandInterface;
use Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;

class AddCarDocumentCommand implements CommandInterface
{
    private $preparedDocument;
    private $repository;
    private $carId;

    public function __construct(CarInMemoryRepository $repository, $carId, DocumentDTO $preparedDocument)
    {
        $this->preparedDocument = $preparedDocument;
        $this->repository       = $repository;
        $this->carId            = $carId;
    }

    public function execute()
    {
        $document    = new DocumentFactory();
        $carDocument = $document->create(DocumentFactory::CAR_DOCUMENT,
                                         $this->preparedDocument->docId,
                                         $this->preparedDocument->title,
                                         $this->preparedDocument->description,
                                         $this->preparedDocument->source
        );

        $car = $this->repository->find($this->carId);
        $car->addCarDocument($carDocument);

        $this->repository->add($car);
    }
}