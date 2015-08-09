<?php

namespace Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Term\Insurance;
use Madkom\Registries\Domain\Car\Term\Review;

class TermFactory
{
    /**
     * @param string $type
     * @param TermDto $termDto
     * @return Insurance|Review
     * @throws UnknownTermTypeException
     */
    public function create($type, TermDto $termDto)
    {

        switch($type)
        {
            case Insurance::TYPE:
                $term = new Insurance();
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
