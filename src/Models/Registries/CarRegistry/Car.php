<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:28
 */

namespace Models\Registries\CarRegistry;


class Car
{
    /**
     * @var int
     */
    private $carId;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var  string
     */
    private $model;

    /**
     * @var string
     */
    private $registrationNumber;

    /**
     * @var string
     */
    private $insurer;

    /**
     * @var string
     */
    private $others;
    private $OC;
    private $AC;
    private $ASS;
    private $review;
}