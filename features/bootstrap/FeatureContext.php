<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use PhpSpec\Event\SuiteEvent;
use Madkom\RegistryApplication\Application\CarManagement\CarDTO;
use Madkom\RegistryApplication\Application\CarManagement\Command\AddCarCommand;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    public static $carRepository;

    /**
     * Initializes context.
     *
     */
    public function __construct()
    {
    }

    /**
     * @BeforeStep
     */
    public static function setup()
    {
        self::$carRepository = new \Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository();
    }

    /**
     * @When dodam nowy samochód:
     */
    public function dodamNowySamochod(TableNode $table)
    {

        $car = $table->getHash();
        foreach ($car as $item) {
            extract($item);
            $dto = new CarDTO($id,
                              $responsiblePerson,
                              $model,
                              $brand,
                              $registrationNumber,
                              $productionDate,
                              $warrantyPeriod,
                              $city,
                              $department
            );

            $newCar = new AddCarCommand($dto, self::$carRepository);
            $newCar->execute();
        }


        throw new PendingException();
    }

    /**
     * @Then chciałbym pobrać samochód :id
     */
    public function chcialbymPobracSamochod($id)
    {
        throw new PendingException();
    }
}
