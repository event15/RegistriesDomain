<?php

namespace Madkom\Registries\Domain\Car\Term;

use Doctrine\Common\Collections\ArrayCollection;
use Madkom\Registries\Domain\Term;
use Madkom\Registries\Domain\TermCollection;
use Madkom\Registries\Domain\TermNotAllowedException;

class CarTermCollection extends ArrayCollection implements TermCollection
{
    /**
     * @param Term $term
     * @throws TermNotAllowedException
     */
    public function addTerm(Term $term)
    {
        if($term instanceof Insurance || $term instanceof Review)
        {
            parent::add($term);
        }
        else
        {
            throw new TermNotAllowedException;
        }
    }

    /**
     * @param Term $term
     * @return mixed
     */
    public function removeTerm(Term $term)
    {
        parent::removeElement($term);
    }

}
