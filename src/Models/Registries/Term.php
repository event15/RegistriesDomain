<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:41
 */

namespace Models\Registries;


class Term
{
    private $termId;
    /**
     * @var \DateTime
     */
    private $dateFrom;

    /**
     * @var \DateTime
     */
    private $dateTo;

    /**
     * @var string
     */
    private $department;

    /**
     * @var int
     */
    private $reminderTime;

    private $regId;

    private $reminderType;
}