<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\AddCarCommand;
use Madkom\RegistryApplication\Application\CarManagement\Command\Car\AddCarDocumentCommand;
use Madkom\RegistryApplication\Application\CarManagement\DocumentDTO;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\DuplicatedVehicleInspectionException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection;

/**
 * Class CarManagementContext.
 *
 * Defines application features from the specific context.
 */
class CarManagementContext extends ContextRepositoryInterface implements Context
{
    /**
     * Initializes context.
     */
/*    public function __construct()
    {
        parent::__construct();
    }*/

    /**
     * @When /^mam następujące dane samochodów, chcę je dodać do repozytorium:$/
     *
     * @param \Behat\Gherkin\Node\TableNode $table
     */
    public function mamNastępujaceDaneSamochodowChceJeDodacDoRepozytorium(TableNode $table)
    {
        $car = $table->getHash();
        foreach ($car as $item) {
            $dto = new CarDTO($item['id'],
                                $item['responsiblePerson'],
                                $item['model'],
                                $item['brand'],
                                $item['registrationNumber'],
                                $item['productionDate'],
                                $item['warrantyPeriod'],
                                $item['city'],
                                $item['department']
            );

            $newCar = new AddCarCommand(self::$carRepository, $dto);
            $newCar->execute();
        }
    }

    /**
     * @Given w repozytorium dodane samochody
     */
    public function wRepozytoriumDodaneSamochody()
    {
        self::$carRepository->isEmpty();
    }

    /**
     * @Then chciałbym pobrać samochód :id
     *
     * @param $id
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException
     */
    public function chcialbymPobracSamochod($id)
    {
        self::$carRepository->find($id);
    }

    /**
     * @Then chciałbym aby nie było możliwe pobranie samochodu :id
     *
     * @param $id
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarFoundException
     */
    public function chcialbymAbyNieByloMozliwePobranieSamochodu($id)
    {
        try {
            self::$carRepository->find($id);
        } catch (CarNotFoundException $e) {
        } catch (CarFoundException $e) {
            throw new CarFoundException('Znaleziono samochód, który nie został dodany do repozytorium.');
        }
    }

    /**
     * @Then chciałbym usunąć samochód :id
     */
    public function chcialbymUsunacSamochod($id)
    {
        self::$carRepository->remove($id);
    }

    /**
     * @Then chciałbym pobrać listę wszystkich samochodów do tablicy
     */
    public function chcialbymPobracListeWszystkichSamochodowDoTablicy()
    {
        self::$carRepository->getAllPositions();
    }

    /**
     * @Then chciałbym zmienić osobę odpowiedzialną na :personId w samochodzie :carId
     */
    public function chcialbymZmienicOsobeOdpowiedzialnaNaWSamochodzie($carId, $personId)
    {
        $selectedCar = self::$carRepository->find($carId);
        $selectedCar->changeResponsiblePersonTo($personId);
    }

    /**
     * @Then chciałbym zmienić miasto na :city w którym się znajduje samochód :carId
     */
    public function chcialbymZmienicMiastoNaWKtorymSieZnajdujeSamochod($carId, $city)
    {
        $selectedCar = self::$carRepository->find($carId);
        $selectedCar->changeCity($city);
    }

    /**
     * @Then w samochodzie :carId chciałbym zmienić dział odpowiedzialny na :department
     */
    public function wSamochodzieChcialbymZmienicDzialOdpowiedzialnyNa($carId, $department)
    {
        $selectedCar = self::$carRepository->find($carId);
        $selectedCar->changeDepartment($department);
    }

    /**
     * @Then chciałbym w samochodzie :carId dodać informację o przeglądzie z numerem :inspectionId, w którym data ostatniego to :lastInspection, a data następnego to :upcomingInspection
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     */
    public function chcialbymWSamochodzieDodacInformacjeOPrzegladzieZNumeremWKtorymDataOstatniegoToADataNastępnegoTo(
        $carId,
        $inspectionId,
        $lastInspection,
        $upcomingInspection
    ) {
        $selectedCar = self::$carRepository->find($carId);
        $newInspection = VehicleInspection::createVehicleInspection($inspectionId,
                                                                    $lastInspection,
                                                                    $upcomingInspection
        );
        try {
            $selectedCar->addVehicleInspection($newInspection);
        } catch (InvalidDatesException $e) {
        }
    }

    /**
     * @Then chciałbym aby nie było możliwe dodanie dwóch przeglądów o takim samym :id do jednego samochodu :carId
     */
    public function chcialbymAbyNieByloMozliweDodanieDwochPrzegladowOTakimSamym($carId, $inspectionId)
    {
        $selectedCar = self::$carRepository->find($carId);
        $newInspection = VehicleInspection::createVehicleInspection($inspectionId, '2015-12-30', '2016-12-30');
        try {
            $selectedCar->addVehicleInspection($newInspection);
        } catch (DuplicatedVehicleInspectionException $e) {
        }
    }

    /**
     * @Then przygotuję nowy plik dowodu rejestracyjnego o następujących parametrach:
     */
    public function przygotujeNowyPlikDowoduRejestracyjnegoONastepujacychParametrach(TableNode $table)
    {
        $documents = $table->getHash();
        foreach ($documents as $document) {
            $dto = new DocumentDTO($document['id'],
                                        $document['source'],
                                        $document['title'],
                                        $document['description']
            );

            $carDocument = new AddCarDocumentCommand(self::$carRepository, $document['carId'], $dto);
            $carDocument->execute();
        }
    }

    /**
     * @Then chciałbym usunąć plik :documentId skanu dowodu rejestracyjnego z samochodu :carId
     */
    public function chcialbymUsunacPlikSkanuDowoduRejestracyjnegoZSamochodu($carId, $documentId)
    {
        $repository = self::$carRepository;
        $selectedCar = $repository->find($carId);
        $selectedCar->getCarDocument();

        try {
            $selectedCar->removeCarDocument($documentId);
            throw new \InvalidArgumentException();
        } catch (\Exception $e) {
        }
    }

    /**
     * @Then chciałbym, aby nie było możliwe usunięcie nieistniejącego pliku :documentId z samochodu :carId
     */
    public function chcialbymAbyNieByloMozliweUsuniecieNieistniejacegoPlikuZSamochodu($carId, $documentId)
    {
        $repository = self::$carRepository;
        $selectedCar = $repository->find($carId);

        try {
            $selectedCar->removeCarDocument($documentId);
            throw new \InvalidArgumentException();
        } catch (\Exception $e) {
        }
    }
}
