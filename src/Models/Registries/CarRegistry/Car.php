<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:28
 */

namespace Models\Registries\CarRegistry;


use Models\Registries\Term;

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

    /**
     * @var array
     */
    private $departments = [];

    /**
     * @var Term
     */
    private $OC;

    /**
     * @var Term
     */
    private $AC;

    /**
     * @var Term
     */
    private $ASS;

    /**
     * @var Term
     */
    private $review;

}