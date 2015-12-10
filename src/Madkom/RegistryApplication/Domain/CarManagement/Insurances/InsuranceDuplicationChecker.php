<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

/**
 * Class InsuranceDuplicationChecker
 *
 * Klasa udostępnia metodę sprawdzającą, czy dane ubezpieczenie już istnieje.
 * Jeżeli data rozpoczęcia wprowadzanego ubezpieczenia jest mniejsza lub równa
 * dacie zakończenia umowy ostatniego ubezpieczenia, to wynik funkcji zwróci TRUE,
 * co będzie oznaczać, że taka operacja jest niedozwolona
 *
 * @package Madkom\RegistryApplication\Domain\CarManagement\Insurances
 */
class InsuranceDuplicationChecker
{
    /**
     * @param \Madkom\RegistryApplication\Domain\CarManagement\Insurances\Insurance $newInsurance
     * @return true|false
     */
    public function checkForDuplicates(array $existingInsurance, Insurance $newInsurance)
    {
        foreach ($existingInsurance as $insurance) {
            if (($newInsurance->getDateFrom() <= $insurance->getDateTo())
                && ($newInsurance->getType() === $insurance->getType())
            ) {
                return true;
            }
        }

        return false;
    }
}