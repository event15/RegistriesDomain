<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:41
 */

namespace Models\Registries;
use Doctrine\Common\Collections\ArrayCollection;

class Term
{
    private $termId;
    private $termType;
    private $dateFrom;
    private $dateTo;
    private $department;
    private $reminder;

    private $cars;

    public function __construct($cars)
    {
        $this->cars = new ArrayCollection();
    }

}