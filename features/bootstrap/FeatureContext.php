<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\AddCarCommand;
use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarNotFoundException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarFoundException;

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
    public function __construct() {}

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
     * @param $id
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\CarFoundException
     */
    public function chcialbymAbyNieByloMozliwePobranieSamochodu($id)
    {
        try {
            self::$carRepository->find($id);
        } catch(CarNotFoundException $e) {

        } catch(CarFoundException $e) {
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
}
