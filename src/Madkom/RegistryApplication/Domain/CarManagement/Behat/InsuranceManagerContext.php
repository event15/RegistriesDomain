<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Madkom\RegistryApplication\Application\CarManagement\Command\Insurance\AddInsuranceCommand;
use Madkom\RegistryApplication\Application\CarManagement\Command\Insurance\AddInsuranceDocumentCommand;
use Madkom\RegistryApplication\Application\CarManagement\DocumentDTO;
use Madkom\RegistryApplication\Application\CarManagement\InsuranceDTO;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\NonexistentInsuranceException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\Exceptions\DuplicatedInsuranceException;

class InsuranceManagerContext extends ContextRepositoryInterface implements Context, SnippetAcceptingContext
{
    /**
     * @Then chciałbym do samochodu :carId dodać ubezpieczenie o następujących danych:
     */
    public function chcialbymDoSamochoduDodacUbezpieczenieONastepujacychDanych($carId, TableNode $table)
    {
        $insurance = $table->getHash();

        foreach ($insurance as $item) {
            $dto = new InsuranceDTO($item['id'],
                                    $item['dateFrom'],
                                    $item['dateTo'],
                                    $item['type']
            );

            $newInsurance = AddInsuranceCommand::add(self::$carRepository, $carId, $dto);
            $newInsurance->execute();
        }
    }

    /**
     * @Then nie można dodać ubezpieczenia do samochodu :carId, gdy różnica między dateFrom i dateTo jest inna niż jeden rok:
     *
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     * @throws \InvalidArgumentException
     */
    public function nieMoznaDodacUbezpieczeniaDoSamochoduGdyRoznicaMiedzyDateFromIDateToJestInnaNizJedenRok($carId, TableNode $table)
    {
        $insurance = $table->getHash();

        foreach ($insurance as $item) {
            $dto = new InsuranceDTO($item['id'],
                                    $item['dateFrom'],
                                    $item['dateTo'],
                                    $item['type']
            );

            $newInsurance = AddInsuranceCommand::add(self::$carRepository, $carId, $dto);

            try {
                $newInsurance->execute();
                throw new \InvalidArgumentException('W tym teście spodziewano się wyjątku InvalidDatesException, ale go nie otrzymano');
            } catch (InvalidDatesException $datesException) {

            }
        }

    }

    /**
     * @Then nie można dodać kolejnego ubezpieczenia do samochodu :carId, którego data rozpoczęcia będzie wcześniej niż data końca poprzedniego:
     * @Then nie można dodać kolejnego ubezpieczenia do samochodu :carId, którego data rozpoczęcia będzie później niż data końca poprzedniego:
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     * @throws \InvalidArgumentException
     */
    public function nieMoznaDodacKolejnegoUbezpieczeniaDoSamochoduKtoregoDataRozpoczeciaBedzieWczesniejNizDataKoncaPoprzedniego($carId, TableNode $table)
    {
        $insurance = $table->getHash();

        foreach ($insurance as $item) {
            $dto = new InsuranceDTO($item['id'],
                                    $item['dateFrom'],
                                    $item['dateTo'],
                                    $item['type']
            );

            $newInsurance = AddInsuranceCommand::add(self::$carRepository, $carId, $dto);

            try {
                $newInsurance->execute();
                throw new \InvalidArgumentException('W tym teście spodziewano się wyjątku InvalidDatesException, ale go nie otrzymano');
            } catch (InvalidDatesException $datesException) {

            } catch (DuplicatedInsuranceException $duplicatesException) {

            }
        }
    }

    /**
     * @Given w repozytorium dodane ubezpieczenia
     */
    public function wRepozytoriumDodaneUbezpieczenia()
    {
        $car = self::$carRepository->find(1);
        $car->getInsurances();
    }

    /**
     * @Then chciałbym do istniejącego ubezpieczenia dodać plik:
     * @Then chciałbym dodać do istniejącego ubezpieczenia kolejny plik:
     * @Then chciałbym aby nie było możliwe dodanie pliku do nieistniejącego ubezpieczenia:
     */
    public function chcialbymDoIstniejacegoUbezpieczeniaDodacPlik(TableNode $table)
    {
        foreach ($table as $item) {
            $dto = new DocumentDTO($item['fileId'],
                                   $item['title'],
                                   $item['description'],
                                   $item['source']
            );


            $newInsuranceDocument = new AddInsuranceDocumentCommand(self::$carRepository,
                                                                    $item['carId'],
                                                                    $item['insuranceId'],
                                                                    $dto
            );

            try {
                $newInsuranceDocument->execute();
            } catch(NonexistentInsuranceException $nonexistent) {
            }
        }
    }

    /**
     * @Then chciałbym aby dla samochodu :carId istniały ubezpieczenia:
     */
    public function chcialbymAbyDlaSamochoduIstnialyUbezpieczenia($carId, TableNode $table)
    {
        $car = self::$carRepository->find($carId);
        $insurances = $car->getInsurances();

        $insurancesId = $table->getHash();

        foreach ($insurancesId as $key => $value) {

        }
    }

    /**
     * @Then chciałbym aby dla samochodu :arg1 nie istniały ubezpieczenia o :arg2:
     */
    public function chcialbymAbyDlaSamochoduNieIstnialyUbezpieczeniaO($arg1, $arg2, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby w samochodzie :arg1 było ubezpieczenie o id :arg2
     */
    public function chcialbymAbyWSamochodzieByloUbezpieczenieOId($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby w samochodzie :arg1 nie było ubezpieczenia o id :arg2
     */
    public function chcialbymAbyWSamochodzieNieByloUbezpieczeniaOId($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie było możliwe dodanie kolejnego pliku o id :arg1
     */
    public function chcialbymAbyNieByloMozliweDodanieKolejnegoPlikuOId($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie była możliwa podmiana istniejącego pliku :arg1
     */
    public function chcialbymAbyNieBylaMozliwaPodmianaIstniejacegoPliku($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym usunąć plik :arg1
     */
    public function chcialbymUsunacPlik($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie było możliwe pobranie pliku :arg1
     */
    public function chcialbymAbyNieByloMozliwePobraniePliku($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie było możliwe usunięcie pliku :arg1
     */
    public function chcialbymAbyNieByloMozliweUsunieciePliku($arg1)
    {
        throw new PendingException();
    }
}
