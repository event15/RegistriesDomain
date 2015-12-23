<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 08.12.15
 * Time: 15:43
 */

namespace Madkom\RegistryApplication\Application\CarManagement\Command\Insurance;

use Madkom\RegistryApplication\Application\CarManagement\Command\CommandInterface;
use Madkom\RegistryApplication\Application\CarManagement\DocumentDTO;
use Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceDocument;

class AddInsuranceDocumentCommand implements CommandInterface
{
    /** @var  \Madkom\RegistryApplication\Domain\CarManagement\CarRepositoryInterface $repository */
    private $repository;
    private $document;
    private $carId;
    private $insuranceId;

    public function __construct(CarRepositoryInterface $repository, $carId, $insuranceId, DocumentDTO $document)
    {
        $this->repository  = $repository;
        $this->carId       = $carId;
        $this->insuranceId = $insuranceId;
        $this->document    = $document;
    }

    public function execute()
    {
        $car       = $this->repository->find($this->carId);
        $insurance = new InsuranceDocument($this->insuranceId,
                                           $this->document->title,
                                           $this->document->description,
                                           $this->document->source
        );

        $car->addInsuranceDocument($this->insuranceId, $insurance);
    }
}