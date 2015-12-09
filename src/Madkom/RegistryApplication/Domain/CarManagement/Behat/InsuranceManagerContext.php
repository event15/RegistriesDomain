<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;

class InsuranceManagerContext implements Context, SnippetAcceptingContext
{
    /**
     * @Then chciałbym do samochodu :carId dodać ubezpieczenie o następujących danych:
     */
    public function chcialbymDoSamochoduDodacUbezpieczenieONastepujacychDanych($carId, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then nie można dodać ubezpieczenia do samochodu :carId, gdy różnica między :dateFrom i :dateTo jest inna niż jeden rok:
     */
    public function nieMoznaDodacUbezpieczeniaDoSamochoduGdyRoznicaMiedzyIJestInnaNizJedenRok($carId, $dateFrom, $dateTo, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then chciałbym do samochodu :arg1 dodać kolejne ubezpieczenie o następujących danych:
     */
    public function chcialbymDoSamochoduDodacKolejneUbezpieczenieONastepujacychDanych($arg1, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then nie można dodać kolejnego ubezpieczenia do samochodu :arg1, którego data rozpoczęcia będzie wcześniej niż data końca poprzedniego:
     */
    public function nieMoznaDodacKolejnegoUbezpieczeniaDoSamochoduKtoregoDataRozpoczeciaBedzieWczesniejNizDataKoncaPoprzedniego($arg1, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then nie można dodać kolejnego ubezpieczenia do samochodu :arg1, którego data rozpoczęcia będzie później niż data końca poprzedniego:
     */
    public function nieMoznaDodacKolejnegoUbezpieczeniaDoSamochoduKtoregoDataRozpoczeciaBedziePozniejNizDataKoncaPoprzedniego($arg1, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given w repozytorium dodane ubezpieczenia
     */
    public function wRepozytoriumDodaneUbezpieczenia()
    {
        throw new PendingException();
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
}
