<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 12:00
 */

namespace Models\Elements;

use Doctrine\Common\Collections\ArrayCollection;

class Term
{
    /** @var  integer $termId */
    private $termId;

    /** @var  string $termType */
    private $termType;

    /** @var  \DateTime $dateFrom */
    private $dateFrom;

    /** @var  \DateTime $dateTo */
    private $dateTo;

    /** @var  string $department */
    private $department;

    /** @var  integer $reminder */
    private $reminder;

    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }
}
