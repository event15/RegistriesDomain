<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Madkom\RegistryApplication\Application\CarManagement\Command\Insurance\AddInsuranceCommand;
use Madkom\RegistryApplication\Application\CarManagement\InsuranceDTO;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;
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
        $car->getInsurance();
    }

    /**
     * @Then chciałbym do istniejącego ubezpieczenia dodać plik:
     */
    public function chcialbymDoIstniejacegoUbezpieczeniaDodacPlik(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym dodać do istniejącego ubezpieczenia kolejny plik:
     */
    public function chcialbymDodacDoIstniejacegoUbezpieczeniaKolejnyPlik(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym aby nie było możliwe dodanie pliku do nieistniejącego ubezpieczenia:
     */
    public function chcialbymAbyNieByloMozliweDodaniePlikuDoNieistniejacegoUbezpieczenia(TableNode $table)
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
