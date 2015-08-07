<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 07.08.15
 * Time: 11:32
 */

namespace Models\DTO;

class Terms
{
    /** @var  integer $termId */
    public $termId;

    /** @var  string $termType */
    public $termType;

    /** @var  \DateTime $dateFrom */
    public $dateFrom;

    /** @var  \DateTime $dateTo */
    public $dateTo;

    /** @var  string $department */
    public $department;

    /** @var  integer $reminder */
    public $reminder;

    public $cars;
}
