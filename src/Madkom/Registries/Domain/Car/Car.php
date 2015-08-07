<?php
/**
 * Created by PhpStorm.
 * User: sczarnop
 * Date: 07.08.15
 * Time: 15:50
 */

namespace Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Position;

/**
 * Class Car
 * @package Madkom\Registries\Domain\Car
 */
class Car extends Position
{

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $number;

}