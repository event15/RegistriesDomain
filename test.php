<?php
require_once __DIR__ . '/vendor/autoload.php';

use Madkom\Registries\Domain\RegistryFactory;
use Madkom\Registries\Domain\Car\CarRegistry;

$registryFactory = new RegistryFactory();

$carRegistry = $registryFactory->create(CarRegistry::TYPE_NAME, 'Rejestr samochodów');


$carFactory      = new \Madkom\Registries\Domain\Car\CarFactory();
$positionFactory = new \Madkom\Registries\Domain\PositionFactory($carFactory);
$termFactory     = new \Madkom\Registries\Domain\TermFactory();

$carDto = new \Madkom\Registries\Domain\Car\CarDto();
$carDto->brand              = 'Opel';
$carDto->model              = 'Astra';
$carDto->registrationNumber = 'GA12345';
$car = $positionFactory->create($carDto);

$termDto = new \Madkom\Registries\Domain\TermDto();
$termDto->expiryDate    = new \DateTime();
$termDto->notifyBefore  = new \DateInterval('P14D');
$termDto->whoToNotify   = new \Madkom\Registries\Domain\Department\DepartmentCollection();
$termDto->whoToNotify->add(new \Madkom\Registries\Domain\Department\Department('Dział handlowy', 'diler@madkom.pl'));
$termDto->whoToNotify->add(new \Madkom\Registries\Domain\Department\Department('Dział rozwoju', 'rozwoj@madkom.pl'));

$term = $termFactory->create(Madkom\Registries\Domain\Car\Term\AC::TYPE, $termDto);
$car->addTerm($term);
$term = $termFactory->create(Madkom\Registries\Domain\Car\Term\OC::TYPE, $termDto);
$car->addTerm($term);
$term = $termFactory->create(Madkom\Registries\Domain\Car\Term\ASS::TYPE, $termDto);
$car->addTerm($term);
$term = $termFactory->create(Madkom\Registries\Domain\Car\Term\Review::TYPE, $termDto);
$car->addTerm($term);

$carRegistry->addPosition($car);

var_dump($car);

