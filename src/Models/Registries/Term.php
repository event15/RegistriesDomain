<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:41
 */

namespace Models\Registries;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Term
 * @package Models\Registries
 */
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

    /** @var ArrayCollection $cars */
    private $cars;

    /**
     * @param $cars
     */
    public function __construct($cars)
    {
        $this->cars = new ArrayCollection();
    }

}