<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 10.12.15
 * Time: 09:57
 */

namespace Madkom\RegistryApplication\Domain\CarManagement\Behat;

use Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository;

abstract class ContextRepositoryInterface
{
    /** @var  \Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository */
    public static $carRepository;

    /**
     * ContextRepositoryInterface constructor.
     */
    public function __construct()
    {
        /** @var  \Madkom\RegistryApplication\Infrastructure\CarManagement\CarInMemoryRepository */
        self::$carRepository = new CarInMemoryRepository();
    }

}