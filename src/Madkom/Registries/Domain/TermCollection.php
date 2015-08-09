<?php

namespace Madkom\Registries\Domain;

/**
 * Interface TermCollection
 * @package Madkom\Registries\Domain\Term
 */
interface TermCollection
{

    /**
     * @param Term $term
     * @throws TermNotAllowedException
     * @return mixed
     */
    public function addTerm(Term $term);

    /**
     * @param Term $term
     * @return mixed
     */
    public function removeTerm(Term $term);

}
