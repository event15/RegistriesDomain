<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 10.12.15
 * Time: 10:13
 */

namespace Madkom\RegistryApplication\Application\CarManagement;

class InsuranceDTO
{
    /** @var  string */
    public $insurerId;

    /** @var  \DateTime */
    public $dateFrom;

    /** @var  \DateTime */
    public $dateTo;

    /** @var  string */
    public $type;

    /**
     * InsuranceDTO constructor.
     *
     * @param string    $insurerId
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param string    $type
     */
    public function __construct($insurerId, $dateFrom, $dateTo, $type)
    {
        $this->insurerId = $insurerId;
        $this->dateFrom  = $dateFrom;
        $this->dateTo    = $dateTo;
        $this->type      = $type;
    }

}