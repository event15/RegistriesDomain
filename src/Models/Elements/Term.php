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

    public function __construct($type, $dateFrom, $dateTo, $department, $reminder)
    {
        $this->termType   = $type;
        $this->dateFrom   = $dateFrom;
        $this->dateTo     = $dateTo;
        $this->department = $department;
        $this->reminder   = $reminder;
        $this->cars = new ArrayCollection();
    }

    public function toArray()
    {
        return array(
            'id'        => $this->termId,
            'type'      => $this->termType,
            'dateFrom'  => $this->dateFrom,
            'dateTo'    => $this->dateTo,
            'department'=> $this->department,
            'reminder'  => $this->reminder
        );
    }

    public function addTerm($element)
    {
        $this->cars->add($element);
    }
}
