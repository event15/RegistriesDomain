<?php

require_once __DIR__ . '/vendor/autoload.php';

use Madkom\Registries\Domain\RegistryFactory;
use Madkom\Registries\Domain\Car\CarRegistry;
$registryFactory = new RegistryFactory();

$carRegistry = $registryFactory->create(CarRegistry::TYPE_NAME, 'Rejestr samochodów');


$carFactory = new \Madkom\Registries\Domain\Car\CarFactory();
$positionFactory = new \Madkom\Registries\Domain\PositionFactory($carFactory);
$termFactory = new \Madkom\Registries\Domain\TermFactory();

$carDto = new \Madkom\Registries\Domain\Car\CarDto();
$carDto->brand = 'Opel';
$carDto->model = 'Astra';
$carDto->number = 'GA12345';
$car = $positionFactory->create($carDto);

$termDto = new \Madkom\Registries\Domain\TermDto();
$termDto->expiryDate = new \DateTime();
$termDto->notifyBefore = new \DateInterval('P1D');
$term = $termFactory->create(\Madkom\Registries\Domain\Car\Term\Insurance::TYPE, $termDto);
$car->addTerm($term);
$carRegistry->addPosition($car);

print_r($carRegistry);

