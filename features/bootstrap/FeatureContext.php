<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\AddCarCommand;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection;

/**
 * Class FeatureContext
 *
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var  \Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository */
    public static $carRepository;

    /**
     * Initializes context.
     *
     */
    public function __construct()
    {
    }

    /**
     * @BeforeSuite
     */
    public static function setUp()
    {
        self::$carRepository = new CarInMemoryRepository();
    }

    /**
     * @When /^mam następujące dane samochodów, chcę je dodać do repozytorium:$/
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

            $newCar = new AddCarCommand($dto, self::$carRepository);
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
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     */
    public function chcialbymWSamochodzieDodacInformacjeOPrzegladzieZNumeremWKtorymDataOstatniegoToADataNastepnegoTo($carId, $inspectionId, $lastInspection, $upcomingInspection)
    {
        echo '<' . $inspectionId . '>';
        $selectedCar   = self::$carRepository->find($carId);
        $newInspection = VehicleInspection::createVehicleInspection($inspectionId, $lastInspection, $upcomingInspection);
        $selectedCar->addVehicleInspection($newInspection);
    }

    /**
     * @Then chciałbym aby nie było możliwe dodanie dwóch przeglądów o takim samym :id do jednego samochodu :carId
     */
    public function chcialbymAbyNieByloMozliweDodanieDwochPrzegladowOTakimSamym($carId, $inspectionId)
    {
        $selectedCar   = self::$carRepository->find($carId);


    }

    /**
     * @Then chciałbym aby nie było możliwe dodanie samochodu z datą ostatniego przeglądu :arg1 większą lub równą od przyszłego :arg2
     */
    public function chcialbymAbyNieByloMozliweDodanieSamochoduZDataOstatniegoPrzegladuWiekszaLubRownaOdPrzyszlego($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then przygotuję :arg1 nowego pliku dowodu rejestracyjnego
     */
    public function przygotujeNowegoPlikuDowoduRejestracyjnego($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then podam ścieżkę :arg1 do pliku, który wyślę na serwer
     */
    public function podamSciezkeDoPlikuKtoryWysleNaSerwer($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then podam tytuł :arg1 z opisem :arg2
     */
    public function podamTytulZOpisem($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given mając dodane pliki z dowodem rejestracyjnym do samochodu
     */
    public function majacDodanePlikiZDowodemRejestracyjnymDoSamochodu()
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym usunąć plik :arg1 ze skanem dowodu rejestracyjnego
     */
    public function chcialbymUsunacPlikZeSkanemDowoduRejestracyjnego($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie było możliwe usunięcie nieistniejącego pliku :arg1
     */
    public function chcialbymAbyNieByloMozliweUsuniecieNieistniejacegoPliku($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym zmienić miasto na Kraków w którym się znajduje samochód :arg1
     */
    public function chcialbymZmienicMiastoNaKrakowWKtorymSieZnajdujeSamochod($arg1)
    {
        throw new PendingException();
    }
}
