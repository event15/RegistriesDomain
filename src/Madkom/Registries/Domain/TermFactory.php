<?php
/**
 * Klasa tworzy nowy typ terminu, w zależności od tego jakie dostanie parametry do funkcji create().
 */

namespace Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\Car\Term\OC;
use Madkom\Registries\Domain\Car\Term\ASS;
use Madkom\Registries\Domain\Car\Term\Review;

/**
 * Class TermFactory
 *
 * @package Madkom\Registries\Domain
 */
class TermFactory
{
    /**
     * Funkcja tworzy terminy.
     *
     * @param         $type
     * @param TermDto $termDto
     *
     * @return AC|ASS|OC|Review
     * @throws UnknownTermTypeException
     */
    public function create($type, TermDto $termDto)
    {
        switch ($type) {
            case AC::TYPE:
                $term = new AC();
                break;

            case OC::TYPE:
                $term = new OC();
                break;

            case ASS::TYPE:
                $term = new ASS();
                break;

            case Review::TYPE:
                $term = new Review();
                break;

            default:
                throw new UnknownTermTypeException('Unknown term type: '. $type);
                break;
        }

        $term->changeExpiryDate($termDto->expiryDate);
        $term->changeNotifyBefore($termDto->notifyBefore);
        $term->changeWhoToNotify($termDto->whoToNotify);

        return $term;
    }
}
